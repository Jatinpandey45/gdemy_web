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


// Authentication Routes...
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');









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
    Route::get('post-list','AdminPostController@postList')->name('admin.post.list.records');
    
    
    /**
     * define jobs post routes
     * 
     */
    
    
    Route::resource('jobs','AdminJobController');
    Route::get('jobs-list','AdminJobController@postList')->name('admin.jobs.list.records');
    Route::get('search-job-tags','AdminJobController@searchTags')->name('jobs.search.tags');

    /*
    |
    | define trash routes
    |
    */

    Route::get('remove-status','TrashController@updateStatusAsTrash')->name('move.trash');



    /**
     * define quiz section routes
     * 
     */

     Route::resource('quiz','AdminQuizController');


});

