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
    return view('login');
});
Route::group(['prefix'=>'admin','middleware'=>'Login'], function(){
	Route::group(['prefix'=>'getimage'], function(){
		// Route::get('get', 'ToolController@getHinh');
		// Route::post('get', 'ToolController@postHinh');

		Route::get('search', 'ToolController@getSearch');
		Route::post('search', 'ToolController@postSearch');
		Route::post('getsearch', 'ToolController@postGetSearch');
	});
	Route::group(['prefix'=>'user'],function(){
		Route::get('list','UserController@getList');
		Route::get('add','UserController@getAdd');
		Route::post('add','UserController@postAdd');
		Route::get('edit/{id}','UserController@getEdit');
		Route::post('edit/{id}','UserController@postEdit');
		Route::get('delete/{id}','UserController@getDelete');
	});
	Route::group(['prefix'=>'folder'],function(){
		Route::get('list/{id}','FolderController@getList');
		Route::post('download/{id}','FolderController@postDownload');

		Route::get('danhsach','FolderController@getDanhsach');
		Route::get('delete/{id}','FolderController@Delete');
	});
	Route::group(['prefix'=>'link'],function(){
		Route::get('list','LinkController@getList');

		Route::post('save', 'LinkController@postSave');
		Route::get('dowload/{id}','LinkController@getDowload');
		Route::get('dowloaddetail/{id}','LinkController@getDowloadDetail');
	});

	Route::group(['prefix'=>'ajax'], function(){
		Route::get('getSoTrang/{idtrang}/{sotrang}', 'AjaxController@getSoTrang');
		Route::get('taothumuc/{tenthumuc}', 'AjaxController@TaoThuMuc');
		Route::get('listthumuc', 'AjaxController@ListThuMuc');
	});
});
Route::get('login' , 'UserController@getLogin');
Route::post('login' , 'UserController@postLogin');
Route::get('logout', 'UserController@Logout');

