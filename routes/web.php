<?php

use Illuminate\Support\Facades\Route;

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
Route::any('admin/brand/create',"admin\BrandController@create");
Route::any('admin/brand/store',"admin\BrandController@store");
Route::any('admin/brand/index',"admin\BrandController@index");
Route::any('admin/brand/upload','admin\BrandController@upload');   
Route::any('admin/brand/edit/{brand_id}','admin\BrandController@edit');   
Route::any('admin/brand/update/{brand_id}','admin\BrandController@update');   
Route::get('admin/brand/delete/{brand_id}','admin\BrandController@destroy');   
Route::get('admin/brand/del','admin\BrandController@del');
Route::get('admin/brand/chang','admin\BrandController@chang'); 