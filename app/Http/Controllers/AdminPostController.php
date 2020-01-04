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

    const LIMIT = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $pagination = Posts::simplePaginate(self::LIMIT);

        $count      = Posts::count();

        return view('admin.posts.index', ['page' => $pagination,'count' => $count]);
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

                        // check for existing tags 

                        $newTag = Tags::where('tag_name',$val)->first();

                        if(is_null($newTag)) {

                            $newTag = new Tags;
                            $newTag->tag_name = $val;
                            $newTag->tag_slug = str_slug($val);
                            $newTag->tag_desc = "--";
                            $newTag->lang_id  = $this->getLocalId();
                            $newTag->save();

                        }
                       
                        $item = $newTag->id;
                    }

                    $tagAssociation = new GkTagPost;
                    $tagAssociation->tag_id = $item;
                    $tagAssociation->post_id = $post->id;
                    $tagAssociation->save();
                }
            }

            DB::commit();

            $http_response_header = ['code' => Response::HTTP_OK, 'message' => trans('message.post_added')];
        } catch (\PDOException $e) {
            // Woopsy
            $http_response_header = ['code' => $e->getCode(), 'message' => $e->getMessage()];
            DB::rollBack();
        }

        return Redirect::route('posts.index')->with('success', $http_response_header);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        
        $month    = MonthTags::all();

        $post     = Posts::getPostById(decrypt($id));

    //  dd($post->toArray());
    
       return view('admin.posts.edit',compact('category', 'month','post','id'));
        
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
        //dd($request->all());


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

            $postId = decrypt($id);
           
            $post = Posts::find($postId);
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
            $postSeo->post_id =  $postId ;
            $postSeo->keyword  = $request->get('post_seo_title');
            $postSeo->description = $request->get('seo_desc');
            $postSeo->titile = "--";
            $postSeo->save();


            /**
             * store cateogry into the database
             * remove existing category
             */

             GkCategoryPost::where('post_id',$postId)->delete();
             

            $category = $request->get('category');
            foreach ($category as $key => $val) {
                $postCategory = new GkCategoryPost;
                $postCategory->category_id = $val;
                $postCategory->post_id = $postId;
                $postCategory->save();
            }


            /**
             * 
             * Store tags into the data either create custom ones and or save existing with ids
             */

             GkTagPost::where('post_id',$postId)->delete();

            $tags = $request->get('tag_name');
            if (!empty($tags)) {
                foreach ($tags as $val) {
                    $item = $val;
                   
                    if (!is_numeric($val)) {

                        // check for existing tags 

                        $newTag = Tags::where('tag_name',$val)->first();

                        if(is_null($newTag)) {

                            $newTag = new Tags;
                            $newTag->tag_name = $val;
                            $newTag->tag_slug = str_slug($val);
                            $newTag->tag_desc = "--";
                            $newTag->lang_id  = $this->getLocalId();
                            $newTag->save();

                        }
                       
                        $item = $newTag->id;
                    }

                    $tagAssociation = new GkTagPost;
                    $tagAssociation->tag_id = $item;
                    $tagAssociation->post_id = $postId;
                    $tagAssociation->save();
                }
            }

            DB::commit();

            $http_response_header = ['code' => Response::HTTP_OK, 'message' => trans('message.post_updated')];
        } catch (\PDOException $e) {
            // Woopsy
            $http_response_header = ['code' => $e->getCode(), 'message' => $e->getMessage()];
            DB::rollBack();
        }

        return Redirect::route('posts.index')->with('success', $http_response_header);


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
            'month',
            'publish_at'
        );

        $limit = $request->input('length');
        $start = ($request->input('page') - 1) * $limit;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        if (!empty($request->input('search.value'))) {

            $search = $request->input('search.value');
            $category =  Posts::with(['Month'])->where('post_title', 'LIKE', "%{$search}%")
                ->orWhere('post_desc', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {

            $category = Posts::with(['Month'])->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

       
        $data = array();
        
        if (!empty($category)) {
            foreach ($category as $row) {

                $nestedData['id'] = $row->id;
                $nestedData['post_title'] = $row->post_title;
                $nestedData['month'] = $row->Month->month_name;
                $nestedData['publish_at'] = $row->publish_at;
                $nestedData['action'] = encrypt($nestedData);
                $nestedData['edit_route'] = route('posts.edit', encrypt($row->id));
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "data"            => $data
        );

        return response()->json($json_data);
    }
}
