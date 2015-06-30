<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Home
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('home', 'HomeController@index');



// Controller
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);



// User Center
Route::group(['prefix' => 'uc',], function() {
    Route::get('edit-avatar', ['as' => 'uc.edit-avatar', 'uses' => 'UserCenterController@editAvatar']);
    Route::post('update-avatar', ['as' => 'uc.update-avatar', 'uses' => 'UserCenterController@updateAvatar']);
});



// Resource
Route::resource('uc', 'UserCenterController');
Route::resource('topic', 'TopicController');
Route::resource('article', 'ArticleController');
Route::resource('blog', 'BlogController');
Route::resource('comment', 'CommentController');



// Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', ['as' => 'adminHome', 'uses' => 'Admin\HomeController@index']);

    // Category
    Route::group(['prefix' => 'category',], function() {
        Route::get('order', ['as' => 'admin.category.order', 'uses' => 'Admin\CategoryController@order']);
        Route::post('order-handle', ['as' => 'admin.category.order-handle', 'uses' => 'Admin\CategoryController@orderHandle']);
    });
    Route::resource('category', 'Admin\CategoryController');

    Route::resource('topic', 'Admin\TopicController');
    Route::resource('article', 'Admin\ArticleController');
    Route::resource('blog', 'Admin\BlogController');
});
