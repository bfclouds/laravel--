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

Route::get('/', function () {
    return view('welcome');
});


//用户模块
//注册页面
Route::get('/register','RegisterController@index');
//注册行为
Route::post('/register','RegisterController@register');
//登录页面
Route::get('/login','LoginController@index');
//登录行为
Route::post('/login','LoginController@login');
//登出行为
Route::get('/logout','LoginController@logout');
//个人设置页面
Route::get('/user/me/setting','UserController@setting');
//个人设置行为
Route::post('/user/me/setting','UserController@settingStore');


//文章模块
//文章列表页
Route::get('/posts','PostController@index');
//创建文章
Route::get('/posts/create','PostController@create');
Route::post('/posts','PostController@store');
//文章详情页
Route::get('/posts/{post}','PostController@show');

//编辑文章
Route::get('/posts/{post}/edit','PostController@edit');
Route::post('/posts/{post}','PostController@update');
//删除文章
Route::get('/posts/{post}/delete','PostController@delete');
//上传图片
Route::post('/posts/image/upload','PostController@imageUplode');


//评论
Route::post('/posts/{user}/comment','PostController@comment');
//zan
Route::get('/posts/{user}/zan','PostController@zan');
//取消赞
Route::get('/posts/{user}/unzan','PostController@unzan');

//个人设置
Route::get('/user/{user}/setting','UserController@setting');
//个人设置行为
Route::post('/user/{user}/setting','UserController@settingStore');

//关注行为
Route::get('/user/{user}/doFan','UserController@fan');
//取消关注行为
Route::get('/user/{user}/doUnFan','UserController@unFan');

//我的主页
Route::get('/user/{user}','UserController@show');
//我的主页行为