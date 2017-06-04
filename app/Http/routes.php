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
Route::group(['middleware'=>'web'],function(){
    Route::get("/admin","AdminController@index");
	Route::get("/administration","AdminController@admin");
	Route::post("/adminload","AdminController@login");
	Route::get("/count","AdminController@count");
	Route::get("/del","AdminController@del");
	Route::get("/changePwd","AdminController@changePwd");
	Route::get("/close","AdminController@close");
Route::get("/userAll","UserController@getUserAll");
});

Route::get("/download","ArticleController@download");
Route::get("/getCount","ArticleController@getCount");
Route::get("/getNew","ArticleController@getNew");


Route::get("/cancelTop","AdminController@cancelTop");
Route::get("/toTop","AdminController@toTop");
Route::get("/toGood","AdminController@toGood");
Route::get("/cancelGood","AdminController@cancelGood");
Route::get("/delart","AdminController@delart");
Route::get("/delAdmin","AdminController@delAdmin");
Route::post("/newAdmin","AdminController@newAdmin");
Route::get("/delre","AdminController@delre");




Route::post("/forget","UserController@forget");
Route::get("/getHead","UserController@Head");
Route::get("/userArticle","ArticleController@userArticle");

Route::post("/message","MessageController@userMessage");
Route::get("/getMessage","MessageController@getMessage");
Route::post("/messagePost","MessageController@messagePost");
Route::get("/delMessage","MessageController@delMessage");


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

Route::get('/load/load', function(){
	return view('index');
});

Route::get('/load/resgin', function(){
	return view('index');
});
// Route::get('/resgin', function(){
// 	return view('index');
// });
Route::get('/user', function(){
	return view('index');
});

Route::get('/talk/{id}', function(){
	return view('index');
});
Route::get('/talk/{id}/{ID}', function(){
	return view('index');
});

Route::get('/user/{index}', function(){
	return view('index');
});

Route::post("/resgin","UserController@resgin");

Route::get("/weather","WeatherController@wea");

Route::post("/pulish","ArticleController@pulish");
Route::post("/report","ArticleController@report");




Route::get("/list","ArticleController@getlist");
Route::get("/getArticle","ArticleController@getOne");
Route::get("/getReport","ArticleController@getReport");
Route::get("/getHot","ArticleController@getHot");
Route::post("/uploadFile","ArticleController@uploadFile");

Route::get('/postSix','UserController@postSix');
Route::get('/postDesc','UserController@postDesc');
Route::get('/postDate','UserController@postDate');
Route::get('/postHobby','UserController@postHobby');

Route::any("/uploadImg","UserController@upload");

Route::get('/send', "MailController@send");
Route::post('/userload','UserController@login');
Route::post('/userload','UserController@login');


// Route::get('/user/login', 'UsersController@login');

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
