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

//Category
Route::get('category', 'AdminApi\CategoryController@index');
Route::post('category', 'AdminApi\CategoryController@store');
Route::get('categoryshow/{id}', 'AdminApi\CategoryController@show');
Route::post('categoryupdate/{id}', 'AdminApi\CategoryController@update');
Route::get('categorydestroy/{id}', 'AdminApi\CategoryController@destroy');
