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


Route::get('/tentang-greenplaza', 'member\\FrontController@about')->name('about') ;
Route::get('/cara-belanja', 'member\\FrontController@carabelanja')->name('cara-belanja') ;
Route::get('/cara-pembayaran', 'member\\FrontController@pembayaran')->name('cara-pembayaran') ;
Route::get('/aturan-penggunaan', 'member\\FrontController@aturan')->name('aturan') ;
Route::get('/syarat-ketentuan', 'member\\FrontController@syarat')->name('syarat') ;
Route::get('/alur-transaksi', 'member\\FrontController@alurtransaksi')->name('alur') ;

Route::get('/dashboard-member', 'member\\FrontController@dashboard');


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
		Route::get('/email_sender', 'Admin\\FrontController@email_sender')->name('.email_sender');
		// Route::get('/res_kom', 'Admin\\FrontController@res_kom')->name('.resolusi_komplain');
		Route::get('/hot_promo', 'Admin\\ProdukController@hot_promo')->name('.hot_promo');
		Route::get('/live_chat', 'Admin\\FrontController@live_chat')->name('.live_chat');
		Route::get('/wishlist', function(){return;})->name('.wishlist');
		Route::get('/dashboard', 'admin\\FrontController@dashboard')->name('.dashboard');

		//EmailController
		Route::post('/send_email', 'admin\\EmailController@email')->name('.send_email');
		Route::get('/list_email', 'admin\\EmailController@list_email')->name('.list_email');
		Route::get('/delete_email/{id}', 'admin\\EmailController@delete')->name('.delete_email');
		Route::get('/resend_email/{id}', 'admin\\EmailController@resend')->name('.resend_email');

		//PageController
		Route::get('/page', 'admin\\PageController@page')->name('.page');
		Route::post('/page_add', 'admin\\PageController@page_add')->name('.page_add');
		Route::get('/page_list', 'admin\\PageController@page_list')->name('.page_list');
		Route::get('/delete_page/{id}', 'admin\\PageController@delete')->name('.delete_page');

		// configurasi
		Route::group(['prefix' => 'config', 'as' => '.config'], function () {
			Route::get('/', 'Superadmin\\Conf_configController@index')->name('.index');
			Route::get('/bank', 'Superadmin\\Conf_configController@bank')->name('.bank');
			Route::get('/profil', 'Superadmin\\Conf_configController@profil')->name('.profil');
			Route::get('/transaction', 'Superadmin\\Conf_configController@transaction')->name('.transaction');
			Route::get('/create', 'Superadmin\\Conf_configController@create')->name('.create');
			Route::post('/store', 'Superadmin\\Conf_configController@store')->name('.store');
			Route::get('/show/{id}', 'Superadmin\\Conf_configController@show')->name('.show');
			Route::get('/edit/{id}', 'Superadmin\\Conf_configController@edit')->name('.edit');
			Route::post('/update/{id}', 'Superadmin\\Conf_configController@update')->name('.update');
			Route::delete('/destroy/{id}', 'Superadmin\\Conf_configController@destroy')->name('.destroy');
		});
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
			Route::get('listmember', 'Admin\\UserController@listmember')->name('.listmember');
			Route::get('editmember/{id}', 'Admin\\UserController@editmember')->name('.editmember');
			Route::post('editmember_data/{id}', 'Admin\\UserController@editmember_data')->name('.editmember_data');
		});
		Route::group(['prefix' => 'produk', 'as' => '.produk'], function () {
			Route::get('/', 'Admin\\ProdukController@index')->name('.index');
			Route::get('/create', 'Admin\\ProdukController@create')->name('.create');
			Route::post('/store', 'Admin\\ProdukController@store')->name('.store');
			Route::get('/show/{id}', 'Admin\\ProdukController@show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\ProdukController@edit')->name('.edit');
			Route::post('update/{id}', 'Admin\\ProdukController@update')->name('.update');
			Route::delete('/destroy/{id}', 'Admin\\ProdukController@destroy')->name('.destroy');
			Route::get('delete/{id}', 'Admin\\ProdukController@delete')->name('.delete');
			Route::get('disabled/{id}', 'Admin\\ProdukController@disabled')->name('.disabled');
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
		Route::group(['prefix' => 'res_kom', 'as' => '.res_kom'], function () {
			Route::get('/', 'Admin\\KomplainController@res_kom')->name('.index');
			Route::get('/create', 'Admin\\KomplainController@res_kom_create')->name('.create');
			Route::post('/store', 'Admin\\KomplainController@res_kom_store')->name('.store');
			Route::get('/show/{id}', 'Admin\\KomplainController@res_kom_show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\KomplainController@res_kom_edit')->name('.edit');
			Route::patch('/update', 'Admin\\KomplainController@res_kom_update')->name('.update');
			Route::delete('/destroy/{id}', 'Admin\\KomplainController@res_kom_destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'withdrawal', 'as' => '.withdrawal'], function () {
			Route::get('/withdrawal_member', 'Admin\\WithdrawalController@withdrawal_member')->name('.withdrawal_member');
			Route::post('/withdrawal_member_reject/{id}', 'Admin\\WithdrawalController@reject')->name('.withdrawal_member_reject');
		});
		Route::group(['prefix' => 'monitoring', 'as' => '.monitoring'], function () {
			Route::get('laporan', 'Admin\\MonitoringController@laporan')->name('.laporan');
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
		Route::get('/dashboard', 'FrontController@dashboard')->name('.dashboard');
		Route::group(['prefix' => 'brand', 'as' => '.brand'], function () {
			Route::get('/', 'BrandController@index')->name('.index');
			Route::get('/create', 'BrandController@create')->name('.create');
			Route::post('/store', 'BrandController@store')->name('.store');
			Route::get('/show/{id}', 'BrandController@show')->name('.show');
			Route::get('/edit/{id}', 'BrandController@edit')->name('.edit');
			Route::patch('/update/{id}', 'BrandController@update')->name('.update');
			Route::delete('/destroy/{id}', 'BrandController@destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'message', 'as' => '.message'], function () {
			Route::get('/', 'MessageController@index')->name('.index');
			Route::get('/create', 'MessageController@create')->name('.create');
			Route::post('/store', 'MessageController@store')->name('.store');
			Route::get('/destroy/{id}', 'MessageController@destroy')->name('.destroy');
			Route::get('arsip/{id}', 'MessageController@arsip')->name('.arsip');
		});
		Route::group(['prefix' => 'produk', 'as' => '.produk'], function () {
			Route::get('/', 'ProdukController@index')->name('.index');
			Route::get('/create', 'ProdukController@create')->name('.create');
			Route::post('/store', 'ProdukController@store')->name('.store');
			Route::get('/show/{id}', 'ProdukController@show')->name('.show');
			Route::get('/edit/{id}', 'ProdukController@edit')->name('.edit');
			Route::patch('/update/{id}', 'ProdukController@update')->name('.update');
			Route::delete('/destroy/{id}', 'ProdukController@destroy')->name('.destroy');
			Route::get('disabled/{id}', 'ProdukController@disabled')->name('.disabled');
		});
		Route::get('/profil', 'UserController@profil')->name('.profil');
		Route::patch('/user/update', 'UserController@update')->name('.user.update');
		Route::get('/user/change_password', 'UserController@change_password')->name('.user.change_password');
		Route::post('/user/change_password_update', 'UserController@change_password_update')->name('.user.change_password_update');
		Route::get('/user/seller_address', 'UserController@seller_address')->name('.user.seller_address');
		Route::post('/user/seller_address_update', 'UserController@seller_address_update')->name('.user.seller_address_update');
		Route::get('/user/upload_foto_profil', 'UserController@upload_foto_profil')->name('.user.upload_foto_profil');
		Route::post('/user/upload_foto_profil_update', 'UserController@upload_foto_profil_update')->name('.user.upload_foto_profil_update');
		Route::get('/user/upload_scan_npwp', 'UserController@upload_scan_npwp')->name('.user.upload_scan_npwp');
		Route::post('/user/upload_scan_npwp_update', 'UserController@upload_scan_npwp_update')->name('.user.upload_scan_npwp_update');
		Route::get('/user/upload_siup', 'UserController@upload_siup')->name('.user.upload_siup');
		Route::post('/user/upload_siup_update', 'UserController@upload_siup_update')->name('.user.upload_siup_update');
		Route::get('/user/set_shipment', 'UserController@set_shipment')->name('.user.set_shipment');
		Route::post('/user/set_shipment_update', 'UserController@set_shipment_update')->name('.user.set_shipment_update');
		// pembeli
		Route::get('/user/buyer_address', 'UserController@buyer_address')->name('.user.buyer_address');
		Route::post('/user/buyer_address_update', 'UserController@buyer_address_update')->name('.user.buyer_address_update');
		Route::get('/biodata', function(){return view('member.buyer.biodata');})->name('.biodata');

		Route::group(['prefix' => 'shipment', 'as' => '.shipment'], function () {
			Route::get('/', 'ShipmentController@index')->name('.index');
			Route::get('/create', 'ShipmentController@create')->name('.create');
			Route::post('/store', 'ShipmentController@store')->name('.store');
			Route::get('/show/{id}', 'ShipmentController@show')->name('.show');
			Route::get('/edit/{id}', 'ShipmentController@edit')->name('.edit');
			Route::patch('/update/{id}', 'ShipmentController@update')->name('.update');
			Route::delete('/destroy/{id}', 'ShipmentController@destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'bank', 'as' => '.bank'], function () {
			Route::get('/', 'BankController@index')->name('.index');
			Route::get('/set_default/{id}', 'BankController@set_default')->name('.set_default');
			Route::get('/create', 'BankController@create')->name('.create');
			Route::post('/store', 'BankController@store')->name('.store');
			Route::get('/show/{id}', 'BankController@show')->name('.show');
			Route::get('/edit/{id}', 'BankController@edit')->name('.edit');
			Route::patch('/update/{id}', 'BankController@update')->name('.update');
			Route::delete('/destroy/{id}', 'BankController@destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'transaction', 'as' => '.transaction'], function () {
			Route::get('/', 'TransactionController@sales')->name('.index');
			Route::get('/sales', 'TransactionController@sales')->name('.sales');
			Route::get('/purchase', 'TransactionController@purchase')->name('.purchase');
			Route::get('/konfirmasi/{id}', 'TransactionController@konfirmasi')->name('.konfirmasi');
			Route::get('/able/{id}', 'TransactionController@able')->name('.able');
			Route::get('/packing/{id}', 'TransactionController@packing')->name('.packing');
			Route::get('/sending/{id}', 'TransactionController@sending')->name('.sending');
			Route::get('/dropping/{id}', 'TransactionController@dropping')->name('.dropping');
			Route::get('/create', 'TransactionController@create')->name('.create');
			Route::post('/store', 'TransactionController@store')->name('.store');
			Route::get('/show/{id}', 'TransactionController@show')->name('.show');
			Route::get('/edit/{id}', 'TransactionController@edit')->name('.edit');
			Route::patch('/update', 'TransactionController@update')->name('.update');
			Route::delete('/destroy/{id}', 'TransactionController@destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'review', 'as' => '.review'], function () {
			Route::get('/', 'ReviewController@index')->name('.index');
			Route::get('/create', 'ReviewController@create')->name('.create');
			Route::post('/store', 'ReviewController@store')->name('.store');
			Route::get('/edit/{id}', 'ReviewController@edit')->name('.edit');
			Route::patch('/update', 'ReviewController@update')->name('.update');
			Route::delete('/destroy/{id}', 'ReviewController@destroy')->name('.destroy');
		});
		Route::get('/cw_bonus', function(){return view('member.history_saldo.saldo_cw_bonus');})->name('.cw_bonus');
		Route::get('/cw_trans', function(){return view('member.history_saldo.saldo_cw_transaksi');})->name('.cw_trans');
		Route::get('/withdrawal', function(){return view('member.withdrawal.index');})->name('.withdrawal');
		Route::get('/rw', function(){return view('member.history_saldo.saldo_rw');})->name('.rw');
		Route::get('/beli_poin', function(){return view('member.hotlist.beli_poin');})->name('.beli_poin');
		// Route::get('/profil_user', function(){return view('member.pengaturan_profil.profil-user');})->name('.profil_user');
		Route::get('/transfer_cw', function(){return view('member.transfer_cw.index');})->name('.transfer_cw');
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
	Route::group(['prefix' => 'midtrans', 'as' => '.midtrans'], function () {
		Route::get('payment', 'MidtransController@payment')->name('.payment');
		Route::get('process', 'MidtransController@simple_process')->name('.simple_process');
		Route::post('process', 'MidtransController@process')->name('.process');
	});
	Route::group(['prefix' => 'content', 'as' => '.content'], function () {
		Route::post('choose-shipment/{id}', 'ContentController@choose_shipment')->name('.choose_shipment');
		Route::get('get_province/{id}', 'ContentController@get_province')->name('.get_province');
		Route::get('get_city/{id}', 'ContentController@get_city')->name('.get_city');
		Route::get('get_subdistrict/{id}', 'ContentController@get_subdistrict')->name('.get_subdistrict');
		Route::get('config_content', function(){return true;})->name('.config_content');
	});
	Route::group(['prefix' => 'modal', 'as' => '.modal'], function () {
		Route::get('form_config', 'ModalController@formConfig')->name('.form_config');
		Route::get('addwishlist/{id}', 'ModalController@addwishlist')->name('.addwishlist');
		Route::get('addchart/{id}', 'ModalController@addChart')->name('.addchart');
		Route::get('pickaddress', 'ModalController@pickAddress')->name('.pickaddress');
		Route::get('addaddress', 'ModalController@addAddress')->name('.addaddress');
		Route::get('trans_detail/{id}', 'ModalController@transDetail')->name('.trans_detail');
		Route::post('trans_detail_post/{id}', 'ModalController@transDetail')->name('.trans_detail_post');
		Route::get('res_kom_transDetail/{id}', 'ModalController@res_kom_transDetail')->name('.res_kom_transDetail');
		Route::get('brand_detail/{id}', 'ModalController@brand_detail')->name('.brand_detail');
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

Route::get('/page/{page}', 'Member\\FrontController@page')->name('.page');
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
