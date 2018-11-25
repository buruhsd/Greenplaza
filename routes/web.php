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


Auth::routes(['verify' => true]);

Route::get('/home', 'Member\\HomeController@index')->name('home')->middleware('verified');
Route::get('/member/home', 'Member\\HomeController@index')->name('member.home');
Route::get('/admin/home', 'Member\\HomeController@index')->name('admin.home')->middleware('auth');
Route::get('/superadmin/home', 'Member\\HomeController@index')->name('superadmin.home')->middleware('auth');

// auth superadmin
Route::group(['middleware' => ['auth', 'roles', 'verified'], 'roles' => ['superadmin']], function () {
});

// auth superadmin & admin
Route::group(['middleware' => ['auth', 'roles', 'verified'], 'roles' => ['superadmin', 'admin']], function () {
	Route::group(['prefix' => 'admin', 'as' => 'admin'], function () {
		Route::group(['prefix' => 'produk', 'as' => '.produk'], function () {
			Route::get('edit/{id}', 'Admin\\ProdukController@edit')->name('.edit');
			Route::post('update/{id}', 'Admin\\ProdukController@update')->name('.update');
			Route::get('delete/{id}', 'Admin\\ProdukController@delete')->name('.delete');
			Route::get('disabled/{id}', 'Admin\\ProdukController@disabled')->name('.disabled');
		});
		Route::get('/email_sender', 'Admin\\FrontController@email_sender')->name('.email_sender');
		Route::get('/res_kom', 'Admin\\FrontController@res_kom')->name('.resolusi_komplain');
		Route::get('/hot_promo', 'Admin\\ProdukController@hot_promo')->name('.hot_promo');
		Route::get('/live_chat', 'Admin\\FrontController@live_chat')->name('.live_chat');
		Route::get('/wishlist', function(){return;})->name('.wishlist');
		Route::get('/dashboard', 'member\\FrontController@admin')->name('.dashboard');

		// configurasi
		Route::group(['prefix' => 'shipment', 'as' => '.shipment'], function () {
			Route::get('/', 'Admin\\ShipmentController@index')->name('.index');
			Route::get('/create', 'Admin\\ShipmentController@create')->name('.create');
			Route::post('/store', 'Admin\\ShipmentController@store')->name('.store');
			Route::get('/show/{id}', 'Admin\\ShipmentController@show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\ShipmentController@edit')->name('.edit');
			Route::patch('/update/{id}', 'Admin\\ShipmentController@update')->name('.update');
			Route::delete('/destroy/{id}', 'Admin\\ShipmentController@destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'bank', 'as' => '.bank'], function () {
			Route::get('/', 'Admin\\BankController@index')->name('.index');
			Route::get('/create', 'Admin\\BankController@create')->name('.create');
			Route::post('/store', 'Admin\\BankController@store')->name('.store');
			Route::get('/show/{id}', 'Admin\\BankController@show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\BankController@edit')->name('.edit');
			Route::patch('/update/{id}', 'Admin\\BankController@update')->name('.update');
			Route::delete('/destroy/{id}', 'Admin\\BankController@destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'brand', 'as' => '.brand'], function () {
			Route::get('/', 'Admin\\BrandController@index')->name('.index');
			Route::get('/create', 'Admin\\BrandController@create')->name('.create');
			Route::post('/store', 'Admin\\BrandController@store')->name('.store');
			Route::get('/show/{id}', 'Admin\\BrandController@show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\BrandController@edit')->name('.edit');
			Route::patch('/update/{id}', 'Admin\\BrandController@update')->name('.update');
			Route::delete('/destroy/{id}', 'Admin\\BrandController@destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'category', 'as' => '.category'], function () {
			Route::get('/', 'Admin\\categoryController@index')->name('.index');
			Route::get('/create', 'Admin\\categoryController@create')->name('.create');
			Route::post('/store', 'Admin\\categoryController@store')->name('.store');
			Route::get('/show/{id}', 'Admin\\categoryController@show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\categoryController@edit')->name('.edit');
			Route::patch('/update/{id}', 'Admin\\categoryController@update')->name('.update');
			Route::delete('/destroy/{id}', 'Admin\\categoryController@destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'user', 'as' => '.user'], function () {
			Route::get('/', 'Admin\\UserController@index')->name('.index');
			Route::get('/create', 'Admin\\UserController@create')->name('.create');
			Route::post('/store', 'Admin\\UserController@store')->name('.store');
			Route::get('/show/{id}', 'Admin\\UserController@show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\UserController@edit')->name('.edit');
			Route::patch('/update/{id}', 'Admin\\UserController@update')->name('.update');
			Route::delete('/destroy/{id}', 'Admin\\UserController@destroy')->name('.destroy');
			Route::get('disabled/{id}', 'Admin\\UserController@disabled')->name('.disabled');
		});
		Route::group(['prefix' => 'produk', 'as' => '.produk'], function () {
			Route::get('/', 'Admin\\ProdukController@index')->name('.index');
			Route::get('/create', 'Admin\\ProdukController@create')->name('.create');
			Route::post('/store', 'Admin\\ProdukController@store')->name('.store');
			Route::get('/show/{id}', 'Admin\\ProdukController@show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\ProdukController@edit')->name('.edit');
			Route::patch('/update', 'Admin\\ProdukController@update')->name('.update');
			Route::delete('/destroy/{id}', 'Admin\\ProdukController@destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'transaction', 'as' => '.transaction'], function () {
			Route::get('/', 'Admin\\TransactionController@index')->name('.index');
			Route::get('/create', 'Admin\\TransactionController@create')->name('.create');
			Route::post('/store', 'Admin\\TransactionController@store')->name('.store');
			Route::get('/show/{id}', 'Admin\\TransactionController@show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\TransactionController@edit')->name('.edit');
			Route::patch('/update', 'Admin\\TransactionController@update')->name('.update');
			Route::delete('/destroy/{id}', 'Admin\\TransactionController@destroy')->name('.destroy');
		});
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

// auth all
Route::group(['middleware' => ['auth']], function () {
	Route::get('/member/home', 'Member\\HomeController@index')->name('member.home');
	Route::get('/category', 'member\\FrontController@category')->name('category');
	Route::get('/brand', 'member\\FrontController@brand')->name('brand');
	Route::get('/detail/{slug}', 'member\\FrontController@detail')->name('detail');
	Route::get('/etalase/{id}', 'member\\FrontController@etalase')->name('etalase');
	Route::get('/shop', 'member\\FrontController@shop')->name('shop');

	Route::get('/profil', function(){return;})->name('profil');
	Route::get('/member/dashboard', function(){return;})->name('member.dashboard');

	//wishlishController
	Route::get('/member/wishlist', 'member\\WishlistController@index')->name('member.wishlist');
	Route::post('/member/addwishlist/{id}', 'Member\\WishlistController@addWishlist')->name('member.addwishlist');
	Route::get('/member/addToChart', 'member\\WishlistController@moveToChart')->name('member.wishlist.moveToChart');
	Route::get('/member/wishlist/delete/{id}', 'member\\WishlistController@destroy')->name('member.wishlist.delete');

	//ChartController
	Route::get('/chart', 'member\\ChartController@chart')->name('chart');
	Route::get('/checkout', 'member\\ChartController@checkout')->name('checkout');
	Route::post('/addchart/{id}', 'member\\ChartController@addChart')->name('addchart');
	Route::get('/chart/destroy/{id}', 'member\\ChartController@destroy')->name('chart.destroy');

	//user_addressController
	Route::get('/member/address', 'member\\User_addressController@chart')->name('member.address');
	Route::post('/member/address/store', 'member\\User_addressController@store')->name('member.address.store');
});

// without auth
Route::group(['prefix' => 'localapi', 'as' => 'localapi', 'namespace' => 'LocalApi'], function () {
	Route::group(['prefix' => 'content', 'as' => '.content'], function () {
		Route::post('choose-shipment/{id}', 'ContentController@choose_shipment')->name('.choose_shipment');
		Route::get('get_province/{id}', 'ContentController@get_province')->name('.get_province');
		Route::get('get_city/{id}', 'ContentController@get_city')->name('.get_city');
		Route::get('get_subdistrict/{id}', 'ContentController@get_subdistrict')->name('.get_subdistrict');
	});
	Route::group(['prefix' => 'modal', 'as' => '.modal'], function () {
		Route::get('addwishlist/{id}', 'ModalController@addwishlist')->name('.addwishlist');
		Route::get('addchart/{id}', 'ModalController@addChart')->name('.addchart');
		Route::get('pickaddress', 'ModalController@pickAddress')->name('.pickaddress');
		Route::get('addaddress', 'ModalController@addAddress')->name('.addaddress');
		Route::get('trans_detail/{id}', 'ModalController@transDetail')->name('.trans_detail');
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
