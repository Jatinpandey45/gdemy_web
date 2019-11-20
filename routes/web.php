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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


//Route::get('/','HomeController@index')->name('user.home.page');

Route::get('/','FrontPageController@index');


/**
 * current affair routes
 */


 
Auth::routes();


Route::group(['middleware' => 'auth'],function(){

    Route::get('/home', 'HomeController@index')->name('home');
  
    Route::resource('categories', 'AdminCategoryController');
    Route::get('category-list','AdminCategoryController@categoryList')->name('admin.category.list.records');
    
    Route::resource('tags','AdminTagController');
    Route::get('tag-list','AdminTagController@tagList')->name('admin.tag.list');
    
    Route::resource('monthly','AdminMonthlyController');
    Route::get('month-list','AdminMonthlyController@monthList')->name('admin.month.list');
   
    Route::resource('posts','AdminPostController');
    Route::get('post-list','AdminPostController@postList')->name('admin.post.list');
    Route::get('search-tags','AdminPostController@searchTags')->name('post.search.tags');
    Route::get('search-seo-tags','AdminPostController@searchTagsSeo')->name('post.admin.search.search');
    Route::get('user-logout','HomeController@logoutUser')->name('user.logout');
    Route::post('post-add-tag','AdminPostController@storetagData')->name('post.add.new.tag');

});

