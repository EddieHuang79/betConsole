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

// 首頁 + 登入

Route::resource('/', 'IndexController');

Route::get('index', ['as'=>'index','uses'=>'IndexController@index']);

Route::get('admin_index', ['as'=>'admin_index','uses'=>'IndexController@admin_index']);

Route::get('login', ['as'=>'login.index','uses'=>'Auth\LoginController@index']);

Route::get('logout', ['as'=>'login.index','uses'=>'Auth\LoginController@logout']);

Route::post('login', ['as'=>'login.process','uses'=>'Auth\LoginController@process']);

Route::post('refresh', ['as'=>'login.refresh','uses'=>'Auth\LoginController@refresh']);

// 使用者

Route::resource('user', 'UserController');

Route::post('extend_user_process', ['as'=>'admin.extend_user_process','uses'=>'UserController@extend_user_process']);

Route::post('invite_friend', ['as'=>'admin.invite_friend','uses'=>'UserController@send_invite_mail']);

// photo

Route::get('photo', ['as'=>'user.photo_index','uses'=>'UserController@photo_index']);

Route::post('photo_upload_process', ['as'=>'user.photo_upload_process','uses'=>'UserController@photo_upload_process']);

// 角色

Route::resource('role', 'RoleController');

// 服務

Route::resource('service', 'ServiceController');

Route::get('service_public', ['as'=>'service.public','uses'=>'ServiceController@service_public']);

Route::get('service_public_process', ['as'=>'service.public_process','uses'=>'ServiceController@service_public_process']);


// record

Route::get('record', ['as'=>'record.index','uses'=>'RecordController@index']);


// msg

Route::resource('msg', 'MsgController');