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
// untuk mobile
Route::post('main_cat', 'Api\\ApiController@category');
Route::post('simpan_resi/{id}', 'Api\\ApiController@simpan_resi');
Route::post('trans_done/{id}', 'Api\\ApiController@trans_done');
Route::post('cancel', 'Api\\ApiController@cancel');
Route::post('sending', 'Api\\ApiController@sending');
Route::post('done_gln/{id}', 'Api\\ApiController@done_gln');
Route::post('gln', 'Api\\ApiController@gln');
Route::post('konfirmasi/{id}', 'Api\\ApiController@konfirmasi');
Route::post('save_checkout', 'Api\\ApiController@saveCheckout');
Route::post('login', 'Api\\ApiController@doLogin');

Route::post('login_web', 'Api\\ApiController@webLogin');
Route::post('register_web', 'Api\\ApiController@webRegister');

Route::post('login_social', 'Api\\ApiController@webLogin_sosial');

Route::post('update_profil', 'Api\\ApiController@update_profil');
Route::post('get_trans_detail/{id}', 'Api\\ApiController@detail_transaksi');
Route::post('get_detail_produk/{id}', 'Api\\ApiController@detail_produk');
Route::post('get_beli/{status}', 'Api\\ApiController@pembelian');
Route::post('get_jual/{status}', 'Api\\ApiController@penjualan');
Route::post('get_produk/{status}', 'Api\\ApiController@produk');
Route::post('get_produk_grosir/{id}', 'Api\\ApiController@produk_grosir');
Route::post('get_log_wallet', 'Api\\ApiController@log_wallet');
Route::post('get_log_transfer', 'Api\\ApiController@log_transfer');
Route::post('get_courier', 'Api\\ApiController@get_courier');
Route::post('get_courier_service', 'Api\\ApiController@get_courier_service');
Route::post('get_user_address', 'Api\\ApiController@get_user_address');
Route::post('get_toko/{id}', 'Api\\ApiController@toko');
Route::post('get_toko_produk/{id}', 'Api\\ApiController@produk_toko');
// saldo, me, pw, gln, dll
Route::post('buy/saldo', 'Api\\ApiController@payment_saldo');
// Route::post('buy/{type}', function($type){
	// return [
 //        'uses' => 'Api\\ApiController@payment_'.$type
 //    ];
	// return Route('Api\\ApiController@payment_'.$type);
	// $action = 'payment_'.$type;
	// return return App::make(action('Api\\ApiController@payment_'.$type))->$action();
	// return action('Api\\ApiController@payment_'.$type);
	// $action = action('Api\\ApiController@payment_'.$type);
	// return return App::make($action);
// });
Route::post('payment_saldo', 'Api\\ApiController@payment_saldo');
// Route::post('get_beli/{status}', function(){
// 	return response()->json(['status' => 200, 'message' => 'pesan', 'data' => [['nama'=>'tes']]]);
// });
// Route::post('get_jual/{status}', function(){
// 	return response()->json(['status' => 200, 'message' => 'pesan', 'data' => [['nama'=>'tes']]]);
// });

Route::post('/login_gi_v2', 'Auth\\LoginController@login_gi');

//auth mobile
Route::post('mobile_login', 'Api\\AuthController@login');


Route::post('done_order', 'Admin\\TransactionController@done_order');
Route::post('done_masedi', 'Admin\\TransactionController@done_masedi');
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

//User_address
Route::get('user_address', 'AdminApi\User_addressController@index');
Route::post('user_address', 'AdminApi\User_addressController@store');
Route::get('user_addressshow/{id}', 'AdminApi\User_addressController@show');
Route::post('user_addressupdate/{id}', 'AdminApi\User_addressController@update');
Route::get('user_addressdestroy/{id}', 'AdminApi\User_addressController@destroy');

//User_bank
Route::get('user_bank', 'AdminApi\User_bankController@index');
Route::post('user_bank', 'AdminApi\User_bankController@store');
Route::get('user_bankshow/{id}', 'AdminApi\User_bankController@show');
Route::post('user_bankupdate/{id}', 'AdminApi\User_bankController@update');
Route::get('user_bankdestroy/{id}', 'AdminApi\User_bankController@destroy');

//User_detail
Route::get('user_detail', 'AdminApi\User_detailController@index');
Route::post('user_detail', 'AdminApi\User_detailController@store');
Route::get('user_detailshow/{id}', 'AdminApi\User_detailController@show');
Route::post('user_detailshow/{id}', 'AdminApi\User_detailController@update');
Route::get('user_detaildestroy/{id}', 'AdminApi\User_detailController@destroy');
Route::get('user_show/{id}', 'AdminApi\User_detailController@show_user');
Route::post('user_show/{id}', 'AdminApi\User_detailController@show_user_update');

Route::post('localapi/midtrans/done', 'LocalApi\\MidtransController@done');

// area
Route::post('province', 'AdminApi\\AreaController@province');
Route::post('city', 'AdminApi\\AreaController@city');
Route::post('subdistrict', 'AdminApi\\AreaController@subdistrict');
