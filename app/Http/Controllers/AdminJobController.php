<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreJobPost;
use App\AdminJobPosts;
use App\AdminJobPostTags;
use App\AdminJobSeo;
use App\AdminJobTags;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
class AdminJobController extends Controller
{
    const LIMIT = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $pagination = AdminJobPosts::simplePaginate(self::LIMIT);

        $count      = AdminJobPosts::count();


        return view('admin.jobs.index', ['page' => $pagination,'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobs.create', compact('category', 'month'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobPost $request)
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

            $post = new AdminJobPosts;
            $post->post_title = $request->get('post_title');
            $post->post_desc  = $request->get('post_desc');
            $post->post_slug  = $request->get('post_slug');
            $post->lang_id    = $this->getLocalId();
            $post->emp_id     = Auth::user()->id;
            $post->featured_image  = $request->get('featured_image', '');
            $post->publish_at   = $request->get('published_at');
            $post->expired_at   = $request->get('expired_at');
            $post->target_device  = $request->get('visibility');
            $post->save();


            /*
            |
            | store tag and post data 
            |
            */

            $postSeo = new AdminJobSeo;
            $postSeo->job_post_id = $post->id;
            $postSeo->keyword  = $request->get('post_seo_title');
            $postSeo->description = $request->get('seo_desc');
            $postSeo->titile = "--";
            $postSeo->save();

            /**
             * 
             * Store tags into the data either create custom ones and or save existing with ids
             */


            $tags = $request->get('tag_name');
            if (!empty($tags)) {
                foreach ($tags as $val) {
                    $item = $val;
                    if (!is_numeric($val)) {

                        $newTag = new AdminJobTags;
                        $newTag->tag_name = $val;
                        $newTag->tag_slug = str_slug($val);
                        $newTag->tag_desc = "--";
                        $newTag->lang_id  = $this->getLocalId();
                        $newTag->save();
                        $item = $newTag->id;
                    }

                    $tagAssociation = new AdminJobPostTags;
                    $tagAssociation->job_tag_id = $item;
                    $tagAssociation->job_post_id = $post->id;
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

        return Redirect::route('jobs.index')->with('success', $http_response_header);
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
      
       // $post     = Posts::getPostById(decrypt($id));
        $post     = AdminJobPosts::getPostById(decrypt($id));
    
       return view('admin.jobs.edit',compact('post','id'));
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
           
            $post = AdminJobPosts::find($postId);
            $post->post_title = $request->get('post_title');
            $post->post_desc  = $request->get('post_desc');
            $post->post_slug  = $request->get('post_slug');
            $post->lang_id    = $this->getLocalId();
            $post->emp_id     = Auth::user()->id;
            $post->featured_image  = $request->get('featured_image', '');
            $post->publish_at   = $request->get('published_at');
            $post->expired_at   = $request->get('expired_at');
            $post->target_device  = $request->get('visibility');
            $post->save();


            /*
            |
            | store tag and post data 
            |
            */

            $postSeo = new AdminJobSeo;
            $postSeo->job_post_id =  $postId ;
            $postSeo->keyword  = $request->get('post_seo_title');
            $postSeo->description = $request->get('seo_desc');
            $postSeo->titile = "--";
            $postSeo->save();




            /**
             * 
             * Store tags into the data either create custom ones and or save existing with ids
             */

            AdminJobPostTags::where('job_post_id',$postId)->delete();
            
            $tags = $request->get('tag_name');
            if (!empty($tags)) {
                foreach ($tags as $val) {
                    $item = $val;
                    if (!is_numeric($val)) {

                        $newTag = new AdminJobTags;
                        $newTag->tag_name = $val;
                        $newTag->tag_slug = str_slug($val);
                        $newTag->tag_desc = "--";
                        $newTag->lang_id  = $this->getLocalId();
                        $newTag->save();
                        $item = $newTag->id;
                    }

                    $tagAssociation = new AdminJobPostTags;
                    $tagAssociation->job_tag_id = $item;
                    $tagAssociation->job_post_id = $postId;
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

        return Redirect::route('jobs.index')->with('success', $http_response_header);

    }


      /**
     * searchTags
     * @param : query string
     */

    public function searchTags(Request $request)
    {
        $searchTerm = $request->get('search', '');

        $result = AdminJobTags::searchTags($searchTerm);

        $returnData = [];

        if (!$result->isEmpty()) {

            foreach ($result as $key => $val) {
                $returnData[$key] = ['value' => $val->id, 'text' => $val->tag_name];
            }
        }

        return response()->json($returnData);
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
     * postList
     * @param : null
     * @return : application/html
     */

    public function postList(Request $request)
    {
        $columns = array(
            'post_title',
            'publish_at'
        );

        $limit = $request->input('length');
        $start = ($request->input('page') - 1) * $limit;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        if (!empty($request->input('search.value'))) {

            $search = $request->input('search.value');
            $category =  AdminJobPosts::where('post_title', 'LIKE', "%{$search}%")
                ->orWhere('post_desc', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {

            $category = AdminJobPosts::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

       
        $data = array();
        
        if (!empty($category)) {
            foreach ($category as $row) {

                $nestedData['id'] = $row->id;
                $nestedData['post_title'] = $row->post_title;
                $nestedData['publish_at'] = $row->publish_at;
                $nestedData['action'] = encrypt($nestedData);
                $nestedData['edit_route'] = route('jobs.edit', encrypt($row->id));
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
