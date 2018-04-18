<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('test', function () {
    return view('test');
});

Route::post('comments/{id}', ['uses'=>'CommentsController@store','as'=>'comments.store']);
Route::get('comments/{id}',  ['uses'=>'CommentsController@edit','as'=>'comments.edit']);
Route::put('comments/{id}',  ['uses'=>'CommentsController@update','as'=>'comments.update']);
Route::delete('comments/{id}',  ['uses'=>'CommentsController@destroy','as'=>'comments.destroy']);
Route::get('comments/{id}/delete',  ['uses'=>'CommentsController@delete','as'=>'comments.delete']);
//Categories
Route::resource('categories', 'CategoryController', ['except' => ['create']]);
Route::resource('pages','PageController',['except'=> ['create','edit','update']]);
Route::get('about','PagesController@getAbout');
Route::get('contact','PagesController@getContact');
Route::post('contact','ContactController@postContact');
Route::get('/','PagesController@getIndex');

Route::resource('posts','PostController');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('{target}','PagesController@getTarget')->where('target','^[a-zA-Z0-9-_\/]+$');



