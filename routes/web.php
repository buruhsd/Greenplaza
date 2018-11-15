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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('layouts.home');
});

//FrontController
Route::get('/register/seller', 'member\\FrontController@reg_seller')->name('register.seller');
Route::get('/login/seller', 'member\\FrontController@log_seller')->name('login.seller');
Route::get('/dashboard', 'member\\FrontController@admin')->name('dashboard');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/member/home', 'Member\\HomeController@index')->name('member.home');
Route::get('/admin/home', 'Member\\HomeController@index')->name('admin.home')->middleware('auth');
Route::get('/superadmin/home', 'Member\\HomeController@index')->name('superadmin.home')->middleware('auth');
Route::get('email_sender', 'Admin\\FrontController@email_sender')->name('email_sender');
Route::get('res_kom', 'Admin\\FrontController@res_kom')->name('resolusi_komplain');
Route::get('hot_promo', 'Admin\\FrontController@hot_promo')->name('hot_promo');
Route::get('live_chat', 'Admin\\FrontController@live_chat')->name('live_chat');

// auth superadmin
Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['superadmin']], function () {
});

// auth superadmin & admin
Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['superadmin', 'admin']], function () {
	Route::group(['prefix' => 'admin', 'as' => 'admin'], function () {
	});
});

// auth admin
Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['admin']], function () {
	Route::group(['prefix' => 'admin', 'as' => 'admin'], function () {
	});
});

// auth admin & member
Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['admin', 'member']], function () {
	Route::group(['prefix' => 'member', 'as' => 'member'], function () {
	});
});

// auth member
Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['member']], function () {
	Route::group(['prefix' => 'member', 'as' => 'member', 'namespace' => 'Member'], function () {
	});
	Route::group(['prefix' => 'member/localapi', 'as' => 'member.localapi', 'namespace' => 'LocalApi'], function () {
		Route::group(['prefix' => 'tab', 'as' => '.tab'], function () {
		});
	});
});

// auth
Route::group(['middleware' => ['auth']], function () {
	Route::get('/member/home', 'Member\\HomeController@index')->name('member.home');
	Route::get('/category', 'member\\FrontController@category')->name('category');
	Route::get('/detail/{id}', 'member\\FrontController@detail')->name('detail');
	Route::get('/etalase/{id}', 'member\\FrontController@etalase')->name('etalase');
	Route::get('/shop', 'member\\FrontController@shop')->name('shop');

	//wishlishController
	Route::get('/member/wishlist', 'member\\WishlistController@index')->name('member.wishlist');
	Route::post('/member/addwishlist/{id}', 'Member\\WishlistController@addWishlist')->name('member.addwishlist');
	Route::get('/member/addToChart', 'member\\WishlistController@moveToChart')->name('member.wishlist.moveToChart');
	Route::get('/member/wishlist/delete/{id}', 'member\\WishlistController@destroy')->name('member.wishlist.delete');

	//ChartController
	Route::get('/chart', 'member\\ChartController@chart')->name('chart');
	Route::get('/checkout', 'member\\ChartController@checkout')->name('member.checkout');
	Route::get('/addchart/{id}', 'member\\ChartController@addChart')->name('addchart');
});

// without auth
Route::group(['prefix' => 'localapi', 'as' => 'localapi', 'namespace' => 'LocalApi'], function () {
	Route::post('choose-shipment/{id}', 'ContentController@choose_shipment')->name('.choose_shipment');
	Route::group(['prefix' => 'modal', 'as' => '.modal'], function () {
		Route::get('addwishlist/{id}', 'ModalController@addwishlist')->name('.addwishlist');
		Route::get('addchart/{id}', 'ModalController@addChart')->name('.addchart');
	});
	Route::group(['prefix' => 'tab', 'as' => '.tab'], function () {
	});
	Route::group(['prefix' => 'content', 'as' => '.content'], function () {
		Route::get('produk_newest', 'ContentController@produk_newest')->name('.produk_newest');
		Route::get('hot_promo', 'ContentController@hot_promo')->name('.hot_promo');
		Route::get('populer', 'ContentController@populer')->name('.populer');
		Route::get('recommended', 'ContentController@recommended')->name('.recommended');
	});
});

// helper
Route::group(['prefix' => 'helper', 'as' => 'helper'], function(){
	Route::get('/{function}/{admin}', function($function, $admin) {
    	return Helpers::$function($admin);
	});
	Route::get('/{function}', function($function) {
    	return Helpers::$function();
	});
});

// Route::get('/member/home', function(){
// 	return "member bos";
// })->name('member.home')->middleware('auth');
// Route::get('/admin/home', function(){
// 	return "admin bos";
// })->name('admin.home')->middleware('auth');
// Route::get('/superadmin/home', function(){
// 	return "superadmin bos";
// })->name('superadmin.home')->middleware('auth');
