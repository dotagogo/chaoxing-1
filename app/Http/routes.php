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

//Route::get('/', function () {
//    return view('welcome');
//});

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
    Route::get('/','Home\IndexController@index'); // 主页
    Route::get('/ask/{question}','Home\IndexController@ask');  // 超星测试
});

// 接入laravel-wechat 
Route::any('/wechat', 'WechatController@serve'); // 接入wechat

/*
Route::get('/users', 'UsersController@users'); // 获取关注用户列表
Route::get('/user/{openId}', 'UsersController@user'); // 根据Id获取用户信息
Route::get('/remark', 'UsersController@remark'); // 根据Id获取用户信息


Route::get('/image', 'MaterialController@image'); // 素材管理图片上传
Route::get('/images', 'MaterialController@images'); // 获取上传图片的列表
Route::get('/voice', 'MaterialController@voice'); // 素材管理音频上传
Route::get('/voices', 'MaterialController@voices'); // 获取上传音频的列表
Route::get('/media/{mediaId}', 'MaterialController@media'); // 素材管理音频上传


Route::get('/message', 'MaterialController@message'); // 群发信息

Route::get('/menu', 'MenuController@menu'); // 自定义菜单
Route::get('/menuAll', 'MenuController@menuAll'); // 获取菜单列表
*/


