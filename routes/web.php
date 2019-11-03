<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('user.home.page');


/**
 * current affair routes
 */

 Route::get('admin','AdminController@index')->name('admin.current.affairs');

 Route::resource('categories', 'AdminCategoryController');
 Route::resource('tags','AdminTagController');
 Route::get('category-list','AdminCategoryController@categoryList')->name('admin.category.list.records');
 Route::get('tag-list','AdminTagController@tagList')->name('admin.tag.list');
 