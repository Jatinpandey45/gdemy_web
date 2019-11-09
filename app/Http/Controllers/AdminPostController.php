<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\MonthTags;
use App\Tags;
use phpDocumentor\Reflection\DocBlock\Tag;

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
    { }

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
        $searchTerm = $request->get('query', '');

        $result = Tags::searchTags($searchTerm);

        $returnData = [];

        if ($result->count() > 0) {

            foreach ($result as $key => $val) {
                $returnData[$key] = ['value' => $val->tag_name, 'data' => $val->_id];
            }
        }

        return response()->json(['suggestions' => $returnData ]);
    }
}
