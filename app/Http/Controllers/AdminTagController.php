<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Tags;
use App\Http\Requests\StoreTagRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;


class AdminTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tags.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {

        try
        {

            $tag = new Tags;
            $tag->tag_name = $request->get('tag_name');
            $tag->tag_slug = $request->get('tag_slug');
            $tag->tag_desc = $request->get('tag_desc','');
            $tag->lang_id  = $this->getLocalId();
            $tag->save();

            $http_response_header = [
                'code' => Response::HTTP_CREATED,
                'message' => trans('message.tag_created_successfully')
            ];

        }catch(QueryException $e) {

            $http_response_header = [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];

        } catch(Exception $e) {

            $http_response_header = [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];

        }
       
        return Redirect::back()->with('success',$http_response_header);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.tags.edit');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * tagList
     * @param :  \Illuminate\Http\Request 
     * @return : application/json
     */

     public function tagList(Request $request)
     {
        $columns = array(
            'tag_name',
            'tag_desc',
            'tag_slug'
        );

        $totalData = Tags::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $tags = Tags::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $tags =  Tags::where('tag_name', 'LIKE', "%{$search}%")
                ->orWhere('tag_slug', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Tags::where('tag_name', 'LIKE', "%{$search}%")
                ->orWhere('tag_slug', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($tags)) {
            foreach ($tags as $row) {


                $nestedData['tag_name'] = $row->tag_name;
                $nestedData['tag_desc'] = $row->tag_desc;
                $nestedData['tag_slug'] = $row->tag_slug;
                $nestedData['action'] = encrypt($nestedData);
                $nestedData['edit_route'] = route('categories.edit',encrypt($row->_id));
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
     }
}
