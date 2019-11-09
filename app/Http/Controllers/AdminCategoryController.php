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
use Yajra\Datatables\Facades\Datatables;

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

    public function edit($id)
    {   
        $decrypt = decrypt($id);
        return view('admin.categories.create');
    }

    /**
     * Display a listing of the resource.
     *  categoryList
     * @return \Illuminate\Http\Response
     */

    public function categoryList(Request $request)
    {
        $columns = array(
            'category_name',
            'category_description',
            'category_slug'
        );

        $totalData = Category::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $category = Category::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $category =  Category::where('category_name', 'LIKE', "%{$search}%")
                ->orWhere('category_slug', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Category::where('category_name', 'LIKE', "%{$search}%")
                ->orWhere('category_slug', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($category)) {
            foreach ($category as $row) {


                $nestedData['category_name'] = $row->category_name;
                $nestedData['category_description'] = $row->category_description;
                $nestedData['category_slug'] = $row->category_slug;
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
