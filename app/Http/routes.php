<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//主页
Route::get('/', function () {
    return view('index');
	// $result = DB::select('select * from forum_user');
 //    return $result;
});

Route::get('/index/{index}', function () {
    return view('index');
	// $result = DB::select('select * from forum_user');
 //    return $result;
});

Route::get('/load', function(){
	return view('index');
});
Route::get('/load/{index}', function(){
	return view('index');
});
Route::get('/resgin', function(){
	return view('index');
});
Route::get('/user', function(){
	return view('index');
});


Route::get('/user/login', 'UsersController@login');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
