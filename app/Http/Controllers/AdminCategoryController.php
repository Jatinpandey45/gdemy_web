<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;

class AdminCategoryController extends Controller
{
    
    public function index()
    {
        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        session()->flush('success', 'Category created successfully.');
        
        return redirect(route('/categories.index'));
    }
}
