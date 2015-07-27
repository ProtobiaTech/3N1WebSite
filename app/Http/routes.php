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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('home', 'HomeController@index');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', ['as' => 'adminHome', 'uses' => 'Admin\HomeController@index']);
    Route::resource('topic', 'Admin\TopicController');
    Route::resource('article', 'Admin\ArticleController');
    Route::resource('blog', 'Admin\BlogController');
});


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'me' => 'MeController',
]);

Route::resource('topic', 'TopicController');
Route::resource('article', 'ArticleController');
Route::resource('blog', 'BlogController');
Route::resource('reply', 'ReplyController');
