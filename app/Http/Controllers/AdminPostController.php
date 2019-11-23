<?php

namespace App\Http\Controllers;

use App\Category;
use App\GkCategoryPost;
use App\GkTagPost;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\MonthTags;
use App\Posts;
use App\PostSeo;
use App\Tags;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $category = Category::all();
        $month    = MonthTags::all();

        return view('admin.posts.create', compact('category', 'month'));
    }

    /**43w2q4 
     * Store a newly created resource in storage.
     *wq
     *   
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {


        /**
         * 
         *  start storing 
         * 
         */


        try {
            DB::beginTransaction();
            // database queries here

            /*
            |
            | store all post data into the database.
            |
            */

            $post = new Posts;
            $post->post_title = $request->get('post_title');
            $post->post_desc  = $request->get('post_desc');
            $post->month_id   = $request->get('month')[0];
            $post->post_slug  = $request->get('post_slug');
            $post->lang_id    = $this->getLocalId();
            $post->emp_id     = Auth::user()->id;
            $post->featured_image  = $request->get('featured_image', '');
            $post->publish_at   = $request->get('published_at');
            $post->target_device  = $request->get('visibility');
            $post->save();


            /*
            |
            | store tag and post data 
            |
            */

            $postSeo = new PostSeo;
            $postSeo->post_id = $post->id;
            $postSeo->keyword  = $request->get('post_seo_title');
            $postSeo->description = $request->get('seo_desc');
            $postSeo->titile = "--";
            $postSeo->save();


            /**
             * store cateogry into the database
             */

            $category = $request->get('category');
            foreach ($category as $key => $val) {
                $postCategory = new GkCategoryPost;
                $postCategory->category_id = $val;
                $postCategory->post_id = $post->id;
                $postCategory->save();
            }


            /**
             * 
             * Store tags into the data either create custom ones and or save existing with ids
             */


            $tags = $request->get('tag_name');
            if (!empty($tags)) {
                foreach ($tags as $val) {
                    $item = $val;
                    if (!is_numeric($val)) {
                       
                        $newTag = new Tags;
                        $newTag->tag_name = $val;
                        $newTag->tag_slug = str_slug($val);
                        $newTag->tag_desc = "--";
                        $newTag->lang_id  = $this->getLocalId();
                        $newTag->save();
                        $item = $newTag->id;
                    }

                    $tagAssociation = new GkTagPost;
                    $tagAssociation->tag_id = $item;
                    $tagAssociation->post_id = $post->id;
                    $tagAssociation->save();
                }
            }

            DB::commit();
        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
        }

        return Redirect::route('posts.index')->with('success', ['code' => Response::HTTP_OK, 'message' => trans('message.post_added')]);
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
     * searchTags
     * @param : query string
     */

    public function searchTags(Request $request)
    {
        $searchTerm = $request->get('search', '');

        $result = Tags::searchTags($searchTerm);

        $returnData = [];

        if (!$result->isEmpty()) {

            foreach ($result as $key => $val) {
                $returnData[$key] = ['value' => $val->id, 'text' => $val->tag_name];
            }
        }

        return response()->json($returnData);
    }





    /**
     * postList
     * @param : null
     * @return : application/html
     */

    public function postList(Request $request)
    {
        $columns = array(
            'post_title',
            'post_desc',
            'month',
            'publish_at'
        );

        $totalData = Posts::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $category = Posts::with(['getMonth'])->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $category =  Posts::with(['getMonth'])->where('post_title', 'LIKE', "%{$search}%")
                ->orWhere('post_desc', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Posts::with(['getMonth'])->where('post_title', 'LIKE', "%{$search}%")
                ->orWhere('post_desc', 'LIKE', "%{$search}%")
                ->count();
        }

        // dd($category->toArray());
        $data = array();
        if (!empty($category)) {
            foreach ($category as $row) {
                
                $nestedData['id'] = $row->id;
                $nestedData['post_title'] = $row->post_title;
                $nestedData['post_desc'] = $row->post_desc;
                $nestedData['month'] = $row->getMonth->month_name;
                $nestedData['publish_at'] = $row->publish_at;
                $nestedData['action'] = encrypt($nestedData);
                $nestedData['edit_route'] = route('posts.edit', encrypt($row->id));
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return response()->json($json_data);
    }
}
