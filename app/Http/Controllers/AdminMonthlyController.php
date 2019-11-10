<?php

namespace App\Http\Controllers;

use App\MonthTags;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMonthTagRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class AdminMonthlyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.monthly_tags.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMonthTagRequest $request)
    {
        try {
            
            $monthTag  = new MonthTags;
            $monthTag->month_name = $request->get('month_name');
            $monthTag->month_slug = $request->get('month_slug');
            $monthTag->month_desc = $request->get('month_desc','');
            $monthTag->lang_id  = $this->getLocalId();
            $monthTag->save();
            

            $response = ['code' => Response::HTTP_CREATED, 'message' => trans('message.')];
        } catch(QueryException $e) 
        {
            $response = [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
      
        }catch (Exception $e) {
            $response = [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }

        return Redirect::back()->with('success', $response);
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
        return view('admin.monthly_tag.edit');
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

    public function monthList(Request $request)
    {
        $columns = array(
            'month_name',
            'month_slug',
            'month_desc'
        );

        $totalData = MonthTags::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $tags = MonthTags::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $tags =  MonthTags::where('month_name', 'LIKE', "%{$search}%")
                ->orWhere('month_slug', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Tags::where('month_name', 'LIKE', "%{$search}%")
                ->orWhere('month_slug', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($tags)) {
            foreach ($tags as $row) {

                $nestedData['month_name'] = $row->month_name;
                $nestedData['month_slug'] = $row->month_slug;
                $nestedData['month_desc'] = $row->month_desc;
                $nestedData['action'] = encrypt($nestedData);
                $nestedData['edit_route'] = route('tags.edit', encrypt($row->id));
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
