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
use App\ActivityLogs;
use App\Lang;

class AdminCategoryController extends Controller
{

    const STATUS_ON  = 'on';


    /**
     * index 
     * @param  : null
     * @return : application/html
     * 
     */
    public function index()
    {
        return view('admin.categories.index')->with('controller', 'categories');
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

            /*
            |
            | store a new category 
            |
            */

            $category = new Category;
            $category->category_name = $request->get('category_name');
            $category->category_slug = $request->get('category_slug');
            $category->category_description = $request->get('category_description', '');
            $category->category_icon = base64_encode(file_get_contents($request->file('category_icon')));
            $category->status = ($request->get('status') == self::STATUS_ON) ? self::ACTIVE_STATUS : self::INACTIVE_STATUS;
            $category->lang_id  = $this->getLocalId();
            $category->save();

            $response = ['code' => Response::HTTP_OK, 'message' => trans('message.category_success')];

        } catch (QueryException $e) {

            $response = ['code' => $e->getCode(), 'message' => $e->getMessage()];
         
            ActivityLogs::create(['payload' => json_encode($response)]);

        } catch (Exception $e) {

            $response = ['code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'message' => $e->getMessage()];
        }

        return Redirect::route('categories.index')->with('success', $response);
    }

    /**
     * edit
     * @param : category object
     * @return : application/html
     */

    public function edit(Category $category)
    {
        return view('admin.categories.create')->with('category', $category);
    }

    /**
     * show
     * @param : null
     * @return : application/html
     */

    public function show()
    { }

    public function update()
    { }

    public function destroy()
    { }
}
