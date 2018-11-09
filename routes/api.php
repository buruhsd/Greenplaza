<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('index', 'AdminApi\PermissionsController@index');

//Bank
Route::get('bank', 'AdminApi\BankController@index');
Route::post('bank', 'AdminApi\BankController@store');
Route::get('bankshow/{id}', 'AdminApi\BankController@show');
Route::post('bankupdate/{id}', 'AdminApi\BankController@update');
Route::get('bankdestroy/{id}', 'AdminApi\BankController@destroy');

//Brand
Route::get('brand', 'AdminApi\BrandController@index');
Route::post('brand', 'AdminApi\BrandController@store');
Route::get('brandshow/{id}', 'AdminApi\BrandController@show');
Route::post('brandupdate/{id}', 'AdminApi\BrandController@update');
Route::get('branddestroy/{id}', 'AdminApi\BrandController@destroy');

//Category
Route::get('category', 'AdminApi\CategoryController@index');
Route::post('category', 'AdminApi\CategoryController@store');
Route::get('categoryshow/{id}', 'AdminApi\CategoryController@show');
Route::post('categoryupdate/{id}', 'AdminApi\CategoryController@update');
Route::get('categorydestroy/{id}', 'AdminApi\CategoryController@destroy');

//Produk_grosir
Route::get('produk_grosir', 'AdminApi\Produk_grosirController@index');
Route::post('produk_grosir', 'AdminApi\Produk_grosirController@store');
Route::get('produk_grosirshow/{id}', 'AdminApi\Produk_grosirController@show');
Route::post('produk_grosirupdate/{id}', 'AdminApi\Produk_grosirController@update');
Route::get('produk_grosirdestroy/{id}', 'AdminApi\Produk_grosirController@destroy');

//Produk_location
Route::get('produk_location', 'AdminApi\Produk_locationController@index');
Route::post('produk_location', 'AdminApi\Produk_locationController@store');
Route::get('produk_locationshow/{id}', 'AdminApi\Produk_locationController@show');
Route::post('produk_locationupdate/{id}', 'AdminApi\Produk_locationController@update');
Route::get('produk_locationdestroy/{id}', 'AdminApi\Produk_locationController@destroy');

//Produk_unit
Route::get('produk_unit', 'AdminApi\Produk_unitController@index');
Route::post('produk_unit', 'AdminApi\Produk_unitController@store');
Route::get('produk_unitshow/{id}', 'AdminApi\Produk_unitController@show');
Route::post('produk_unitupdate/{id}', 'AdminApi\Produk_unitController@update');
Route::get('produk_unitdestroy/{id}', 'AdminApi\Produk_unitController@destroy');

//Produk
Route::get('produk', 'AdminApi\ProdukController@index');
Route::post('produk', 'AdminApi\ProdukController@store');
Route::get('produkshow/{id}', 'AdminApi\ProdukController@show');
Route::post('produkupdate/{id}', 'AdminApi\ProdukController@update');
Route::get('produkdestroy/{id}', 'AdminApi\ProdukController@destroy');
