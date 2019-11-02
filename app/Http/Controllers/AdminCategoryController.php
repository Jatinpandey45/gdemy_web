<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class AdminCategoryController extends Controller
{
    /**
     * index 
     * @param  : null
     * @return : application/html
     * 
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * create
     * @param : null
     * @return : application/html
     */

    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * store
     * @param : CreateCategoryRequest
     * @return : result with success or failure
     */

    public function store(CreateCategoryRequest $request)
    {
        try {

            Category::create($request->all());

            $response = ['code' => Response::HTTP_OK, 'message' => trans('message.category_success')];

        } catch (QueryException $e) {

            $response = ['code' => $e->getCode(), 'message' => $e->getMessage()];
            Log::error("DB:ERROR:", $response);
            
        } catch (Exception $e) {
            $response = ['code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'message' => $e->getMessage()];
        }

        return Redirect::route('categories.index')->with('success', $response);
    }


    public function edit(Category $category)
    {
        return view('admin.categories.create')->with('category', $category);
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
