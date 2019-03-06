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
Route::get('/change/language/{id}',function($lang){
    Session::put('my_locale','id');
    return redirect()->back();
});

Route::get('/comming-soon', 'Member\\FrontController@comming');

// ganti password transaksi
Route::get('password/reset_trx', 'Member\\UserController@pass_trx_reset')->name('password.request_trx');
Route::post('password/email_trx', 'Member\\UserController@pass_trx_reset_email')->name('password.email_trx');
Route::get('password/change_trx/{token}', 'Member\\UserController@pass_trx_reset_change')->name('password.change_trx');

// Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');
Route::get('/register/{token}','Auth\VerifManualController@activating')->name('activating-account');
Route::get('/re_send_noauth', 'Auth\\VerifManualController@re_send_page')->name('re_send');
Route::post('/re_send_noauth', 'Auth\\VerifManualController@re_send_noauth')->name('re_send_noauth');
// Password Reset Routes...
Route::get('password/reset', 'Auth\\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/change_password/{token}', 'Auth\\ForgotPasswordController@change_password')->name('password.change');

//HOME
Route::get('/', 'Member\\FrontController@index')->name('home');
// page info greenplaza
Route::get('/tentang-greenplaza', 'Member\\FrontController@about')->name('about') ;
Route::get('/cara-belanja', 'Member\\FrontController@carabelanja')->name('cara-belanja') ;
Route::get('/cara-pembayaran', 'Member\\FrontController@pembayaran')->name('cara-pembayaran') ;
Route::get('/aturan-penggunaan', 'Member\\FrontController@aturan')->name('aturan') ;
Route::get('/syarat-ketentuan', 'Member\\FrontController@syarat')->name('syarat') ;
Route::get('/alur-transaksi', 'Member\\FrontController@alurtransaksi')->name('alur') ;

Route::get('/dashboard-member', 'Member\\FrontController@dashboard');

//FrontController
Route::get('/register/seller', 'Member\\FrontController@reg_seller')->name('register.seller');
Route::get('/login/seller', 'Member\\FrontController@log_seller')->name('login.seller');


// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'Member\\HomeController@index')->name('home');
Route::get('/admin/home', 'Member\\HomeController@index')->name('admin.home')->middleware('auth');
Route::get('/superadmin/home', 'Member\\HomeController@index')->name('superadmin.home')->middleware('auth');

// auth superadmin
Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['superadmin']], function () {
});

// auth superadmin & admin
Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['superadmin', 'admin']], function () {
	Route::group(['prefix' => 'admin', 'as' => 'admin'], function () {
		// Route::group(['prefix' => 'user', 'as' => '.user'], function () {
		// 	Route::get('/set_shipment', 'UserController@set_shipment')->name('.set_shipment');
		// 	Route::post('/set_shipment_update', 'UserController@set_shipment_update')->name('.set_shipment_update');
		// });
		Route::get('/email_sender', 'Admin\\FrontController@email_sender')->name('.email_sender');
		// Route::get('/res_kom', 'Admin\\FrontController@res_kom')->name('.resolusi_komplain');
		Route::get('/hot_promo', 'Admin\\ProdukController@hot_promo')->name('.hot_promo');
		Route::post('/hot_promo_create', 'Admin\\ProdukController@crete_hot')->name('.create_hot');
		Route::get('/live_chat', 'Admin\\FrontController@live_chat')->name('.live_chat');
		Route::get('/wishlist', function(){return;})->name('.wishlist');
		Route::get('/dashboard', 'Admin\\FrontController@dashboard')->name('.dashboard');
		//seller
		Route::get('/dashboarddetail', 'Admin\\FrontController@dashboarddetail')->name('.dashboarddetail');
		Route::get('/dashboarddetailseller/{id}', 'Admin\\FrontController@dashboarddetailseller')->name('.dashboarddetailseller');
		Route::get('/dashboardhotlist', 'Admin\\FrontController@dashboardhotlist')->name('.dashboardhotlist');
		Route::get('/dashboardiklan', 'Admin\\FrontController@dashboardiklan')->name('.dashboardiklan');
		Route::get('/dashboardpincode', 'Admin\\FrontController@dashboardpincode')->name('.dashboardpincode');
		//member
		Route::get('/dashboarddetailmember', 'Admin\\FrontController@dashboarddetailmember')->name('.dashboarddetailmember');
		Route::get('/dashboardhotlistmember', 'Admin\\FrontController@dashboardhotlistmember')->name('.dashboardhotlistmember');
		Route::get('/dashboardiklanmember', 'Admin\\FrontController@dashboardiklanmember')->name('.dashboardiklanmember');
		Route::get('/dashboardpincodemember', 'Admin\\FrontController@dashboardpincodemember')->name('.dashboardpincodemember');
		Route::post('password_seller/{id}', 'Admin\\NeedApprovalController@password_seller')->name('.password_seller');
		Route::get('changepassword_seller/{id}', 'Admin\\NeedApprovalController@changepassword_seller')->name('.changepassword_seller');

		//EmailController
		Route::post('/send_email', 'Admin\\EmailController@email')->name('.send_email');
		Route::get('/list_email', 'Admin\\EmailController@list_email')->name('.list_email');
		Route::get('/delete_email/{id}', 'Admin\\EmailController@delete')->name('.delete_email');
		Route::get('/resend_email/{id}', 'Admin\\EmailController@resend')->name('.resend_email');

		//MasediController
		Route::get('/list_transaction_masedi', 'Admin\\MasediController@list')->name('.list_masedi');
		Route::get('/list_transaction_gln_paid', 'Admin\\MasediController@list_gln_paid')->name('.list_gln');
		Route::get('/list_transaction_gln_notpaid', 'Admin\\MasediController@list_gln_notpaid')->name('.list_gln_notpaid');
		Route::get('/listsaldo_masedi', 'Admin\\MasediController@listsaldo')->name('.list_masedi_saldo');
		Route::get('/listswallet_gln', 'Admin\\MasediController@walletgln')->name('.list_gln_wallet');

		//PageController
		Route::get('/page', 'Admin\\PageController@page')->name('.page');
		Route::post('/page_add', 'Admin\\PageController@page_add')->name('.page_add');
		Route::get('/page_list', 'Admin\\PageController@page_list')->name('.page_list');
		Route::get('/delete_page/{id}', 'Admin\\PageController@delete')->name('.delete_page');

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
			Route::get('/', 'Admin\\CategoryController@index')->name('.index');
			Route::post('/', 'Admin\\CategoryController@index_json')->name('.index_json');
			Route::get('/parent', 'Admin\\CategoryController@indexparent')->name('.indexparent');
			Route::get('/child', 'Admin\\CategoryController@indexchild')->name('.indexchild');
			Route::get('/create', 'Admin\\CategoryController@create')->name('.create');
			Route::post('/store', 'Admin\\CategoryController@store')->name('.store');
			Route::get('/show/{id}', 'Admin\\CategoryController@show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\CategoryController@edit')->name('.edit');
			Route::patch('/update/{id}', 'Admin\\CategoryController@update')->name('.update');
			Route::get('/destroy/{id}', 'Admin\\CategoryController@destroy')->name('.destroy');
			// Route::post('/try/{id}', 'Admin\\CategoryController@try')->name('.try');
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
			Route::get('/block/{id}', 'Admin\\ProdukController@block')->name('.block');
			Route::get('/active/{id}', 'Admin\\ProdukController@active')->name('.active');
			Route::get('/show/{id}', 'Admin\\ProdukController@show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\ProdukController@edit')->name('.edit');
			Route::patch('update/{id}', 'Admin\\ProdukController@update')->name('.update');
			Route::get('/destroy/{id}', 'Admin\\ProdukController@destroy')->name('.destroy');
			Route::get('delete/{id}', 'Admin\\ProdukController@delete')->name('.delete');
			Route::get('disabled/{id}', 'Admin\\ProdukController@disabled')->name('.disabled');
		});
		Route::group(['prefix' => 'transaction', 'as' => '.transaction'], function () {
			Route::get('/', 'Admin\\TransactionController@index')->name('.index');
			Route::get('/paid', 'Admin\\TransactionController@paid')->name('.paid');
			Route::get('/not_paid', 'Admin\\TransactionController@notyet')->name('.notyet');
			Route::get('/create', 'Admin\\TransactionController@create')->name('.create');
			Route::post('/store', 'Admin\\TransactionController@store')->name('.store');
			Route::get('/show/{id}', 'Admin\\TransactionController@show')->name('.show');
			Route::get('/edit/{id}', 'Admin\\TransactionController@edit')->name('.edit');
			Route::get('/edit_trans/{id}', 'Admin\\TransactionController@edit_trans')->name('.edit_trans');
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
		Route::group(['prefix' => 'needapproval', 'as' => '.needapproval'], function () {
			//GLN
			Route::get('/gln', 'Admin\\NeedApprovalController@gln')->name('.gln');
			Route::get('/try', 'Admin\\NeedApprovalController@try')->name('.try');
			Route::get('/gln_send/{order_id}/{id}', 'Admin\\NeedApprovalController@send_coin')->name('.gln_send');
			Route::get('/gln_sendback/{order_id}/{id}', 'Admin\\NeedApprovalController@sendback_coin')->name('.gln_sendback');

			//WITHDRAWAL
			Route::get('/withdrawal_member', 'Admin\\NeedApprovalController@withdrawal_member')->name('.withdrawal_member');
			Route::get('/withdrawal_seller', 'Admin\\NeedApprovalController@withdrawal_seller')->name('.withdrawal_seller');
			Route::post('/withdrawal_member_reject/{id}', 'Admin\\NeedApprovalController@reject')->name('.withdrawal_member_reject');
			//SALDOIKLAN
			Route::get('/saldoiklan', 'Admin\\NeedApprovalController@iklan')->name('.saldoiklan');
			Route::get('/konfirmasi_iklan/{id}', 'Admin\\NeedApprovalController@konfirmasi_iklan')->name('.konfirmasi_iklan');
			Route::get('/approve_admin/{id}', 'Admin\\NeedApprovalController@approve_admin')->name('.approve_admin');
			Route::get('/tolak/{id}', 'Admin\\NeedApprovalController@tolak')->name('.tolak');
			//IKLAN
			//khusus
			Route::get('/banner_khusus', 'Admin\\NeedApprovalController@banner_khusus')->name('.banner_khusus');
			Route::get('/bannerkhusus_review', 'Admin\\NeedApprovalController@bannerkhusus_review')->name('.bannerkhusus_review');
			Route::get('/bannerkhusus_aktif', 'Admin\\NeedApprovalController@bannerkhusus_aktif')->name('.bannerkhusus_aktif');
			Route::get('/bannerkhusus_ditolak', 'Admin\\NeedApprovalController@bannerkhusus_ditolak')->name('.bannerkhusus_ditolak');
			//slider
			Route::get('/banner_slider', 'Admin\\NeedApprovalController@banner_slider')->name('.banner_slider');
			Route::get('/bannerslider_review', 'Admin\\NeedApprovalController@bannerslider_review')->name('.bannerslider_review');
			Route::get('/bannerslider_aktif', 'Admin\\NeedApprovalController@bannerslider_aktif')->name('.bannerslider_aktif');
			Route::get('/bannerslider_ditolak', 'Admin\\NeedApprovalController@bannerslider_ditolak')->name('.bannerslider_ditolak');
			//seller
			Route::get('/banner_seller', 'Admin\\NeedApprovalController@banner_seller')->name('.banner_seller');
			Route::get('/bannerseller_review', 'Admin\\NeedApprovalController@bannerslider_review')->name('.bannerslider_review');
			Route::get('/bannerseller_aktif', 'Admin\\NeedApprovalController@bannerseller_aktif')->name('.bannerseller_aktif');
			Route::get('/bannerseller_ditolak', 'Admin\\NeedApprovalController@bannerseller_ditolak')->name('.bannerseller_ditolak');
			//pembeli
			Route::get('/banner_pembeli', 'Admin\\NeedApprovalController@banner_pembeli')->name('.banner_pembeli');
			Route::get('/bannerpembeli_review', 'Admin\\NeedApprovalController@bannerslider_review')->name('.bannerslider_review');
			Route::get('/bannerpembeli_aktif', 'Admin\\NeedApprovalController@bannerpembeli_aktif')->name('.bannerpembeli_aktif');
			Route::get('/bannerpembeli_ditolak', 'Admin\\NeedApprovalController@bannerpembeli_ditolak')->name('.bannerpembeli_ditolak');
			//baris
			Route::get('/baris_seller', 'Admin\\NeedApprovalController@baris_seller')->name('.baris_seller');
			Route::get('/baris_pembeli', 'Admin\\NeedApprovalController@baris_pembeli')->name('.baris_pembeli');

			//LIST MEMBER/SELLER
			//member
			Route::get('listmember', 'Admin\\NeedApprovalController@listmember')->name('.listmember');
			Route::get('detailmember/{id}', 'Admin\\NeedApprovalController@detailmember')->name('.detailmember');
			Route::post('password_member/{id}', 'Admin\\NeedApprovalController@password_member')->name('.password_member');
			Route::get('changepassword_member/{id}', 'Admin\\NeedApprovalController@changepassword_member')->name('.changepassword_member');
			Route::get('editmember/{id}', 'Admin\\NeedApprovalController@editmember')->name('.editmember');
			Route::post('editmember_data/{id}', 'Admin\\NeedApprovalController@editmember_data')->name('.editmember_data');
			//seller
			Route::get('listseller', 'Admin\\NeedApprovalController@listseller')->name('.listseller');
			Route::get('detailseller/{id}', 'Admin\\NeedApprovalController@detailseller')->name('.detailseller');
			Route::post('password_seller/{id}', 'Admin\\NeedApprovalController@password_seller')->name('.password_seller');
			Route::get('changepassword_seller/{id}', 'Admin\\NeedApprovalController@changepassword_seller')->name('.changepassword_seller');
			//PRODUK ADMIN
			Route::get('produkadmin', 'Admin\\NeedApprovalController@produkadmin')->name('.produkadmin');
			Route::get('produkadmin_block', 'Admin\\NeedApprovalController@produkadmin_block')->name('.produkadmin_block');
			Route::get('create_produkadmin', 'Admin\\NeedApprovalController@create_produk')->name('.create_produk');
			Route::get('/block_product/{id}', 'Admin\\ProdukController@block')->name('.block');
			Route::get('/active_product/{id}', 'Admin\\ProdukController@active')->name('.active');


			//TRANSAKSI HOTLIST
			Route::get('hotlist', 'Admin\\NeedApprovalController@hotlist')->name('.hotlist');
			Route::get('/konfirmasi_hotlist/{id}', 'Admin\\NeedApprovalController@konfirmasi_hotlist')->name('.konfirmasi_hotlist');
			Route::get('/approve_adminhotlist/{id}', 'Admin\\NeedApprovalController@approve_adminhotlist')->name('.approve_adminhotlist');
			Route::get('/tolakhotlist/{id}', 'Admin\\NeedApprovalController@tolakhotlist')->name('.tolakhotlist');

			//TRANSAKSI BARANG
			Route::get('transaction', 'Admin\\NeedApprovalController@barang')->name('.barang');

			//TRANSAKSI PINCODE
			Route::get('pincode', 'Admin\\NeedApprovalController@pincode')->name('.pincode');
			Route::get('/konfirmasi_pincode/{id}', 'Admin\\NeedApprovalController@konfirmasi_pincode')->name('.konfirmasi_pincode');
			Route::get('/approve_adminpincode/{id}', 'Admin\\NeedApprovalController@approve_adminpincode')->name('.approve_adminpincode');
			Route::get('/tolakpincode/{id}', 'Admin\\NeedApprovalController@tolakpincode')->name('.tolakpincode');
		});

		Route::group(['prefix' => 'konfigurasi', 'as' => '.konfigurasi'], function () {
		//ATUR ALAMAT
			Route::get('/admin_address', 'Admin\\KonfigurasiController@seller_address')->name('.admin_address');
			Route::post('/admin_address_update', 'Admin\\KonfigurasiController@seller_address_update')->name('.seller_address_update');
		//SETTING HARGA
			//REG SELLER
			Route::get('regseller', 'Admin\\KonfigurasiController@regseller')->name('.regseller');
			Route::get('tambahregseller', 'Admin\\KonfigurasiController@tambah_regseller')->name('.tambah');

			//HARGA IKLAN
			Route::get('hargaiklan', 'Admin\\KonfigurasiController@hargaiklan')->name('.hargaiklan');

			//HARGA BELI SALDO
			Route::get('hargabelisaldo', 'Admin\\KonfigurasiController@hargabeli')->name('.hargabeli');
			Route::get('tambah_hargabelisaldo', 'Admin\\KonfigurasiController@tambah_hargabeli')->name('.tambah_hargabeli');
			Route::get('update_hargabelisaldo', 'Admin\\KonfigurasiController@update_hargabeli')->name('.update_hargabeli');

		//SETTING IKLAN
			//IKLAN SLIDER
			Route::get('iklanslider', 'Admin\\KonfigurasiController@iklanslider')->name('.iklanslider');
			Route::get('tambah_iklanslider', 'Admin\\KonfigurasiController@tambah_iklanslider')->name('.tambah_iklanslider');

			//IKLAN BANNER KHUSUS
			Route::get('iklan', 'Admin\\KonfigurasiController@iklanbanner')->name('.iklanbanner');
			Route::get('tambah_iklan', 'Admin\\KonfigurasiController@tambah_iklanbanner')->name('.tambah_iklanbanner');
			Route::post('add_iklan', 'Admin\\KonfigurasiController@add_iklanbanner')->name('.add_iklanbanner');
			Route::get('delete_iklan/{id}', 'Admin\\KonfigurasiController@delete_iklan')->name('.delete_iklan');
			Route::get('edit_iklan/{id}', 'Admin\\KonfigurasiController@edit_iklan')->name('.edit_iklan');
			Route::post('edit_iklanadd/{id}', 'Admin\\KonfigurasiController@edit_iklanadd')->name('.edit_iklanadd');
			Route::get('publish/{id}', 'Admin\\KonfigurasiController@publish')->name('.publish');
			Route::get('unpublish/{id}', 'Admin\\KonfigurasiController@unpublish')->name('.unpublish');

		//PROFILE GREENPLAZA
			//OFFICIAL EMAIL
			Route::get('officialemail', 'Admin\\KonfigurasiController@officialemail')->name('.officialemail');
			Route::get('delete_email/{id}', 'Admin\\KonfigurasiController@delete_email')->name('.delete_email');

		//SETTING AKUN
			//AKUN ADMIN
			Route::get('akunadmin', 'Admin\\KonfigurasiController@akunadmin')->name('.akunadmin');
			Route::get('tambah_akunadmin', 'Admin\\KonfigurasiController@tambah_akunadmin')->name('.tambah_akunadmin');
			Route::post('add', 'Admin\\KonfigurasiController@add')->name('.add');
			Route::get('deleteakun/{id}', 'Admin\\KonfigurasiController@deleteadmin')->name('.deleteadmin');

			//PAGELIST
			Route::get('pagelist', 'Admin\\KonfigurasiController@pagelist')->name('.pagelist');
			Route::get('tambah_pagelist', 'Admin\\KonfigurasiController@tambah_pagelist')->name('.tambah_pagelist');
			Route::post('add_page', 'Admin\\KonfigurasiController@add_page')->name('.add_page');
			Route::get('status_active/{id}', 'Admin\\KonfigurasiController@status_active')->name('.status_active');
			Route::get('status_non_active/{id}', 'Admin\\KonfigurasiController@status_non_active')->name('.status_non_active');
			Route::get('edit_page/{id}', 'Admin\\KonfigurasiController@edit_page')->name('.edit_page');
			Route::post('edit_page_add/{id}', 'Admin\\KonfigurasiController@edit_page_add')->name('.edit_page_add');
			Route::get('perviewpage/{id}', 'Admin\\KonfigurasiController@perview')->name('.perview');
			Route::get('deletepage/{id}', 'Admin\\KonfigurasiController@deletepage')->name('.deletepage');

		//GRADE
			//member
			Route::get('grademember', 'Admin\\KonfigurasiController@grademember')->name('.grademember');
			Route::post('add_grademember', 'Admin\\KonfigurasiController@add_grademember')->name('.add_grademember');
			Route::post('grademember/{id}', 'Admin\\KonfigurasiController@update_grademember')->name('.update_grademember');
			Route::get('delete_grademember/{id}', 'Admin\\KonfigurasiController@delete_grademember')->name('.delete_grademember');

			//seller
			Route::get('gradeseller', 'Admin\\KonfigurasiController@gradeseller')->name('.gradeseller');
			Route::post('add_gradeseller', 'Admin\\KonfigurasiController@add_gradeseller')->name('.add_gradeseller');
			Route::post('gradeseller/{id}', 'Admin\\KonfigurasiController@update_gradeseller')->name('.update_gradeseller');
			Route::get('delete_gradeseller/{id}', 'Admin\\KonfigurasiController@delete_gradeseller')->name('.delete_gradeseller');

			//UPDATE PASS
			Route::get('updatepassword', 'Admin\\KonfigurasiController@updatepass')->name('.updatepass');
			Route::post('changepassword/{id}', 'Admin\\KonfigurasiController@changepass')->name('.changepass');

			//ATURKURIR
			Route::get('/set_shipment_admin', 'Admin\\KonfigurasiController@set_shipment')->name('.set_shipment_admin');
			Route::post('/set_shipment_update_admin', 'Admin\\KonfigurasiController@set_shipment_update')->name('.set_shipment_update_admin');
		});

		Route::group(['prefix' => 'monitoring', 'as' => '.monitoring'], function () {
			//Laporan
			Route::get('laporan', 'Admin\\MonitoringController@laporan')->name('.laporan');
			Route::get('laporan_transfer', 'Admin\\MonitoringController@laporan_list_transfer')->name('.laporan_transfer');
			Route::get('laporan_dikirim', 'Admin\\MonitoringController@laporan_list_dikirim')->name('.laporan_dikirim');
			Route::get('laporan_sampai', 'Admin\\MonitoringController@laporan_list_sampai')->name('.laporan_sampai');
			//Profit
			Route::get('profit', 'Admin\\MonitoringController@profit')->name('.profit');
			Route::get('profit_detail', 'Admin\\MonitoringController@profit_detail')->name('.profit_detail');
			//Wallet
			Route::get('wallet_sellerlist', 'Admin\\MonitoringController@wallet_sellerlist')->name('.wallet_sellerlist');
			Route::get('editsaldoseller/{id}', 'Admin\\MonitoringController@editsaldoseller')->name('.editsaldoseller');
			Route::get('editsaldomember/{id}', 'Admin\\MonitoringController@editsaldomember')->name('.editsaldomember');
			Route::post('editsaldoseller_cw/{id}', 'Admin\\MonitoringController@editsaldoseller_cw')->name('.editsaldoseller_cw');
			Route::post('editsaldoseller_rw/{id}', 'Admin\\MonitoringController@editsaldoseller_rw')->name('.editsaldoseller_rw');
			Route::post('editsaldoseller_transaksi/{id}', 'Admin\\MonitoringController@editsaldoseller_transaksi')->name('.editsaldoseller_transaksi');
			Route::post('editsaldoseller_iklan/{id}', 'Admin\\MonitoringController@editsaldoseller_iklan')->name('.editsaldoseller_iklan');
			Route::post('editsaldoseller_pincode/{id}', 'Admin\\MonitoringController@editsaldoseller_pincode')->name('.editsaldoseller_pincode');
			Route::get('wallet_memberlist', 'Admin\\MonitoringController@wallet_memberlist')->name('.wallet_memberlist');
			//Log_activity
			Route::get('log_activity', 'Admin\\MonitoringController@log')->name('.activity');
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
	// mengirim ulang email aktivasi kepada user login
	Route::get('/resend_mail', 'Auth\\VerifManualController@re_send_mail')->name('re_send_mail');
	Route::group(['prefix' => 'member', 'as' => 'member', 'namespace' => 'Member'], function () {
		Route::get('/dashboard', 'FrontController@dashboard')->name('.dashboard');
	});
});
Route::group(['middleware' => ['auth', 'roles', 'is_active'], 'roles' => ['member']], function () {
	Route::group(['prefix' => 'member', 'as' => 'member', 'namespace' => 'Member'], function () {
		// Route::get('/dashboard', 'FrontController@dashboard')->name('.dashboard');
		// Sales & purchase
		Route::group(['prefix' => 'transaction', 'as' => '.transaction'], function () {
			Route::get('/', 'TransactionController@sales')->name('.index');
			Route::get('/create', 'TransactionController@create')->name('.create');
			Route::post('/store', 'TransactionController@store')->name('.store');
			Route::get('/show/{id}', 'TransactionController@show')->name('.show');
			Route::get('/edit/{id}', 'TransactionController@edit')->name('.edit');
			Route::patch('/update', 'TransactionController@update')->name('.update');
			Route::delete('/destroy/{id}', 'TransactionController@destroy')->name('.destroy');
			// sales
			Route::get('/sales', 'TransactionController@sales')->name('.sales');
			Route::get('/able/{id}', 'TransactionController@able')->name('.able');
			Route::get('/packing/{id}', 'TransactionController@packing')->name('.packing');
			Route::post('/sending', 'TransactionController@sending')->name('.sending');
			Route::get('/add_resi/{id}', 'TransactionController@add_resi')->name('.add_resi');
			Route::post('/add_resi/{id}', 'TransactionController@add_resi')->name('.post_add_resi');
			// purchase
			Route::get('/purchase', 'TransactionController@purchase')->name('.purchase');
			Route::get('/konfirmasi/{id}', 'TransactionController@konfirmasi')->name('.konfirmasi');
			Route::get('/konfirmasi_all/{id}', 'TransactionController@konfirmasi_all')->name('.konfirmasi_all');
			Route::get('/dropping/{id}', 'TransactionController@dropping')->name('.dropping');
			Route::get('/done_gln/{order_id}', 'TransactionController@done_gln')->name('.done_gln');
		});
		Route::group(['prefix' => 'komplain', 'as' => '.komplain'], function () {
			Route::post('/store_komplain', 'KomplainController@store_komplain')->name('.store_komplain');
			Route::post('/update_komplain/{id}', 'KomplainController@update_komplain')->name('.update_komplain');
			Route::get('/done_komplain/{id}', 'KomplainController@done_komplain')->name('.done_komplain');
			// sales
			Route::get('/', 'KomplainController@index')->name('.index');
			// purchase
			Route::get('/buyer', 'KomplainController@buyer')->name('.buyer');
		});
		Route::group(['prefix' => 'solusi', 'as' => '.solusi'], function () {
			Route::get('/approve_solusi/{id}', 'SolusiController@approve_solusi')->name('.approve_solusi');
			Route::post('/add_shipment_buyer/{id}', 'SolusiController@add_shipment_buyer')->name('.add_shipment_buyer');
			Route::get('/approve_shipment_buyer/{id}', 'SolusiController@approve_shipment_buyer')->name('.approve_shipment_buyer');
			Route::post('/add_shipment_seller/{id}', 'SolusiController@add_shipment_seller')->name('.add_shipment_seller');
			Route::get('/approve_shipment_seller/{id}', 'SolusiController@approve_shipment_seller')->name('.approve_shipment_seller');
		});
		// Get Penjual
		Route::group(['prefix' => 'wallet', 'as' => '.wallet'], function () {
			Route::get('/create_gln', 'WalletController@create_gln')->name('.create_gln');
			Route::get('/withdrawal', 'WalletController@withdrawal')->name('.withdrawal');
			Route::post('/withdrawal', 'WalletController@withdrawal')->name('.withdrawal');
			Route::get('/transfer_cw', 'WalletController@transfer_cw')->name('.transfer_cw');
			Route::post('/transfer_cw', 'WalletController@transfer_cw')->name('.transfer_cw');
			Route::get('/transfer_rw', 'WalletController@transfer_rw')->name('.transfer_rw');
			Route::post('/transfer_rw', 'WalletController@transfer_rw')->name('.transfer_rw');
			Route::get('/', 'WalletController@index')->name('.index');
			Route::get('/type/{slug}', 'WalletController@type')->name('.type');
			Route::get('/cw_bonus', 'WalletController@cw_bonus')->name('.cw_bonus');
			Route::get('/cw_trans', 'WalletController@cw_trans')->name('.cw_trans');
			Route::get('/rw', 'WalletController@rw')->name('.rw');
		});
		// Pengaturan Profil
		Route::get('/profil', 'UserController@profil')->name('.profil');
		Route::group(['prefix' => 'user', 'as' => '.user'], function () {
			Route::get('/sponsor', 'UserController@sponsor')->name('.sponsor');
			Route::patch('/update', 'UserController@update')->name('.update');
			Route::get('/change_password', 'UserController@change_password')->name('.change_password');
			Route::post('/change_password_update', 'UserController@change_password_update')->name('.change_password_update');
			Route::get('/pass_trx', 'UserController@pass_trx')->name('.pass_trx');
			Route::post('/pass_trx_update', 'UserController@pass_trx_update')->name('.pass_trx_update');
			Route::get('/seller_address', 'UserController@seller_address')->name('.seller_address');
			Route::post('/seller_address_update', 'UserController@seller_address_update')->name('.seller_address_update');
			Route::get('/upload_foto_profil', 'UserController@upload_foto_profil')->name('.upload_foto_profil');
			Route::post('/upload_foto_profil_update', 'UserController@upload_foto_profil_update')->name('.upload_foto_profil_update');
			Route::get('/upload_scan_npwp', 'UserController@upload_scan_npwp')->name('.upload_scan_npwp');
			Route::post('/upload_scan_npwp_update', 'UserController@upload_scan_npwp_update')->name('.upload_scan_npwp_update');
			Route::get('/upload_siup', 'UserController@upload_siup')->name('.upload_siup');
			Route::post('/upload_siup_update', 'UserController@upload_siup_update')->name('.upload_siup_update');
			// pembeli
			Route::get('/buyer_address', 'UserController@buyer_address')->name('.buyer_address');
		});
		Route::get('/biodata', function(){return view('member.buyer.biodata');})->name('.biodata');
		// Pesan & Diskusi
		Route::group(['prefix' => 'produk', 'as' => '.produk'], function () {
			Route::group(['prefix' => 'discuss', 'as' => '.discuss'], function () {
				Route::get('/', 'Produk_discussController@index')->name('.index');
				Route::get('/create', 'Produk_discussController@create')->name('.create');
				Route::post('/store', 'Produk_discussController@store')->name('.store');
				Route::get('/destroy/{id}', 'Produk_discussController@destroy')->name('.destroy');
				Route::get('arsip/{id}', 'Produk_discussController@arsip')->name('.arsip');
				Route::group(['prefix' => 'reply', 'as' => '.reply'], function () {
					Route::post('/store', 'Produk_discussController@reply_store')->name('.store');
				});
			});
		});
		Route::group(['prefix' => 'message', 'as' => '.message'], function () {
			Route::get('/', 'MessageController@index')->name('.index');
			Route::get('/create/{store_slug}', 'MessageController@create')->name('.create');
			Route::post('/store', 'MessageController@store')->name('.store');
			Route::get('/destroy/{id}', 'MessageController@destroy')->name('.destroy');
			Route::get('arsip/{id}', 'MessageController@arsip')->name('.arsip');
		});
		// Hot List
		Route::group(['prefix' => 'hotlist', 'as' => '.hotlist'], function () {
			Route::get('/buy_poin', 'HotlistController@buy_poin')->name('.buy_poin');
			Route::post('/buy_poin_store', 'HotlistController@buy_poin_store')->name('.buy_poin_store');
			Route::get('/konfirmasi/{id}', 'HotlistController@konfirmasi')->name('.konfirmasi');
			Route::post('/to_confirm/{$id}', 'HotlistController@to_confirm')->name('.to_confirm');
			Route::post('/to_cancel/{$id}', 'HotlistController@to_cancel')->name('.to_cancel');
			Route::get('/tagihan', 'HotlistController@tagihan')->name('.tagihan');
			Route::get('/history', 'HotlistController@history')->name('.history');
		});
		// Produk & Brand
		Route::group(['prefix' => 'brand', 'as' => '.brand'], function () {
			Route::get('/', 'BrandController@index')->name('.index');
			Route::get('/create', 'BrandController@create')->name('.create');
			Route::post('/store', 'BrandController@store')->name('.store');
			Route::get('/show/{id}', 'BrandController@show')->name('.show');
			Route::get('/edit/{id}', 'BrandController@edit')->name('.edit');
			Route::patch('/update/{id}', 'BrandController@update')->name('.update');
			Route::delete('/destroy/{id}', 'BrandController@destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'produk', 'as' => '.produk'], function () {
			Route::get('/', 'ProdukController@index')->name('.index');
			Route::get('/create', 'ProdukController@create')->name('.create');
			Route::post('/store', 'ProdukController@store')->name('.store');
			Route::get('/show/{id}', 'ProdukController@show')->name('.show');
			Route::get('/edit/{id}', 'ProdukController@edit')->name('.edit');
			Route::get('/edit_get/{id}', 'ProdukController@edit_get')->name('.edit_get');
		    Route::post('/edit_get/post', 'ProdukController@edit_get_post')->name('.edit_get_post');
			Route::patch('/update/{id}', 'ProdukController@update')->name('.update');
			Route::delete('/destroy/{id}', 'ProdukController@destroy')->name('.destroy');
			Route::get('/disabled/{id}', 'ProdukController@disabled')->name('.disabled');
			Route::get('/hotlist/{id}', 'ProdukController@hotlist')->name('.hotlist_id');
			Route::get('/hotlist', 'ProdukController@hotlist')->name('.hotlist');
			Route::post('/hotlist', 'ProdukController@hotlist')->name('.hotlist');
		});
		// PIN Code
		Route::group(['prefix' => 'pincode', 'as' => '.pincode'], function () {
			Route::get('/buy_pincode', 'PincodeController@buy_pincode')->name('.buy_pincode');
			Route::post('/buy_pincode_store', 'PincodeController@buy_pincode_store')->name('.buy_pincode_store');
			Route::get('/konfirmasi/{id}', 'PincodeController@konfirmasi')->name('.konfirmasi');
			Route::post('/to_confirm/{$id}', 'PincodeController@to_confirm')->name('.to_confirm');
			Route::post('/to_cancel/{$id}', 'PincodeController@to_cancel')->name('.to_cancel');
			Route::get('/list', 'PincodeController@list')->name('.history');
			Route::get('/tagihan', 'PincodeController@tagihan')->name('.tagihan');
		});
		// Pasang Iklan
		Route::group(['prefix' => 'iklan', 'as' => '.iklan'], function () {
			Route::get('/beli_saldo', 'IklanController@beli_saldo')->name('.beli_saldo');
			Route::post('/beli_saldo_store', 'IklanController@beli_saldo_store')->name('.beli_saldo_store');
			Route::get('/konfirmasi/{id}', 'IklanController@konfirmasi')->name('.konfirmasi');
			Route::get('/history', function(){return view('member.iklan.history');})->name('.history');
			Route::get('/baris', 'IklanController@baris')->name('.baris');
			Route::get('/add_baris', 'IklanController@add_baris')->name('.add_baris');
			Route::post('/add_baris', 'IklanController@add_baris')->name('.add_baris');
			Route::get('/slider', 'IklanController@slider')->name('.slider');
			Route::get('/add_slider', 'IklanController@add_slider')->name('.add_slider');
			Route::post('/add_slider', 'IklanController@add_slider')->name('.add_slider');
			Route::get('/banner', 'IklanController@banner')->name('.banner');
			Route::get('/add_banner', 'IklanController@add_banner')->name('.add_banner');
			Route::post('/add_banner', 'IklanController@add_banner')->name('.add_banner');
			Route::get('/banner_khusus', 'IklanController@banner_khusus')->name('.banner_khusus');
			Route::get('/add_banner_khusus', 'IklanController@add_banner_khusus')->name('.add_banner_khusus');
			Route::post('/add_banner_khusus', 'IklanController@add_banner_khusus')->name('.add_banner_khusus');
			Route::get('/tagihan', 'IklanController@tagihan')->name('.tagihan');
		});
		// Atur Kurir
		Route::group(['prefix' => 'user', 'as' => '.user'], function () {
			Route::get('/set_shipment', 'UserController@set_shipment')->name('.set_shipment');
			Route::post('/set_shipment_update', 'UserController@set_shipment_update')->name('.set_shipment_update');
		});
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
			Route::post('/store', 'BankController@store')->name('.store');
			Route::post('/update/{id}', 'BankController@update')->name('.update');
			Route::delete('/destroy/{id}', 'BankController@destroy')->name('.destroy');
		});
		Route::group(['prefix' => 'review', 'as' => '.review'], function () {
			Route::get('/', 'ReviewController@index')->name('.index');
			Route::get('/create', 'ReviewController@create')->name('.create');
			Route::post('/store', 'ReviewController@store')->name('.store');
			Route::get('/edit/{id}', 'ReviewController@edit')->name('.edit');
			Route::patch('/update', 'ReviewController@update')->name('.update');
			Route::delete('/destroy/{id}', 'ReviewController@destroy')->name('.destroy');
		});
		//buyer address
		Route::group(['prefix' => 'address', 'as' => '.address'], function () {
			Route::get('/set_default/{id}', 'User_addressController@set_default')->name('.set_default');
			Route::post('/store', 'User_addressController@store')->name('member.address.store');
			Route::post('/update/{id}', 'User_addressController@update')->name('member.address.update');
			Route::delete('/destroy/{id}', 'User_addressController@destroy')->name('.destroy');
		});
	});
	Route::group(['prefix' => 'member/localapi', 'as' => 'member.localapi', 'namespace' => 'LocalApi'], function () {
		Route::group(['prefix' => 'tab', 'as' => '.tab'], function () {
		});
	});
});

// tanpa auth #frontController
Route::get('/detail/{slug}', 'Member\\FrontController@detail')->name('detail');
Route::get('/etalase/{user_store}', 'Member\\FrontController@etalase')->name('etalase');
Route::get('/category', 'Member\\FrontController@category')->name('category');
Route::get('/brand', 'Member\\FrontController@brand')->name('brand');

// semua auth
Route::group(['middleware' => ['auth']], function () {
	Route::group(['middleware' => ['is_active']], function () {
		//wishlishController
		Route::get('/member/addToChart', 'Member\\WishlistController@moveToChart')->name('member.wishlist.moveToChart');
		Route::get('/member/wishlist/delete/{id}', 'Member\\WishlistController@destroy')->name('member.wishlist.delete');
		//ChartController
		Route::get('/checkout', 'Member\\ChartController@checkout')->name('checkout');
	});
	Route::get('/member/home', 'Member\\HomeController@index')->name('member.home');
	//wishlishController
	Route::get('/member/wishlist', 'Member\\WishlistController@index')->name('member.wishlist');
	Route::post('/member/addwishlist/{id}', 'Member\\WishlistController@addWishlist')->name('member.addwishlist');
	//ChartController
	Route::get('/chart', 'Member\\ChartController@chart')->name('chart');
	Route::post('/addchart/{id}', 'Member\\ChartController@addChart')->name('addchart');
	Route::get('/chart/destroy/{id}', 'Member\\ChartController@destroy')->name('chart.destroy');
});

// tanpa auth
Route::group(['prefix' => 'localapi', 'as' => 'localapi', 'namespace' => 'LocalApi'], function () {
	Route::group(['prefix' => 'midtrans', 'as' => '.midtrans'], function () {
		// need email active
		Route::group(['middleware' => ['is_active']], function () {
			Route::get('payment', 'MidtransController@payment')->name('.payment');
			// Route::get('re_payment_code/{code}', 'MidtransController@re_payment_code')->name('.re_payment_code');
			Route::get('re_payment/{code}', 'MidtransController@re_payment')->name('.re_payment');
			Route::get('hotlist_payment/{code}', 'MidtransController@hotlist_payment')->name('.hotlist_payment');
			Route::get('pincode_payment/{code}', 'MidtransController@pincode_payment')->name('.pincode_payment');
			Route::get('iklan_payment/{code}', 'MidtransController@iklan_payment')->name('.iklan_payment');
			Route::get('process', 'MidtransController@simple_process')->name('.simple_process');
			Route::post('process', 'MidtransController@process')->name('.process');
		});
		// Route::post('done', 'MidtransController@done')->name('.done');
	});
	Route::group(['prefix' => 'masedi', 'as' => '.masedi'], function () {
		// need email active
		Route::group(['middleware' => ['is_active']], function () {
			Route::get('payment', 'MasediController@payment')->name('.payment');
			Route::get('qr/{code}', 'MasediController@qr')->name('.qr');
		});
		// Route::post('done', 'MidtransController@done')->name('.done');
	});
	Route::group(['prefix' => 'gln', 'as' => '.gln'], function () {
		// need email active
		Route::group(['middleware' => ['is_active']], function () {
			Route::get('payment', 'GlnController@payment')->name('.payment');
			Route::get('re_payment/{code}', 'GlnController@re_payment')->name('.re_payment');
		});
		// Route::post('done', 'MidtransController@done')->name('.done');
	});
	Route::group(['prefix' => 'content', 'as' => '.content'], function () {
		// need email active
		Route::group(['middleware' => ['is_active']], function () {
			Route::post('choose-shipment/{id}', 'ContentController@choose_shipment')->name('.choose_shipment');
			Route::get('get_solusi/{id}', 'ContentController@get_solusi')->name('.get_solusi');
			Route::get('ballance_gln/{address}', 'ContentController@ballance_gln')->name('.ballance_gln');
		});
		Route::get('get_province/{id}', 'ContentController@get_province')->name('.get_province');
		Route::get('get_city/{id}', 'ContentController@get_city')->name('.get_city');
		Route::get('get_subdistrict/{id}', 'ContentController@get_subdistrict')->name('.get_subdistrict');
		Route::get('get_db_province/{id}', 'ContentController@get_db_province')->name('.get_db_province');
		Route::get('get_db_city/{id}', 'ContentController@get_db_city')->name('.get_db_city');
		Route::get('get_db_subdistrict/{id}', 'ContentController@get_db_subdistrict')->name('.get_db_subdistrict');
		Route::get('get_hotlist/{id}', 'ContentController@get_hotlist')->name('.get_hotlist');
		Route::get('config_content', function(){return true;})->name('.config_content');
	});
	Route::group(['prefix' => 'modal', 'as' => '.modal'], function () {
		// need email active
		Route::group(['middleware' => ['is_active']], function () {
			Route::get('addchart/{id}', 'ModalController@addChart')->name('.addchart');
			Route::get('trans_detail/{id}', 'ModalController@transDetail')->name('.trans_detail');
			Route::post('trans_detail_post/{id}', 'ModalController@transDetail')->name('.trans_detail_post');
			Route::group(['prefix' => 'komplain', 'as' => '.komplain'], function () {
				Route::get('add_shipment_buyer/{id}', 'ModalController@komplain_resi_buyer')->name('.add_shipment_buyer');
				Route::get('add_shipment_seller/{id}', 'ModalController@komplain_resi_seller')->name('.add_shipment_seller');
			});
			Route::get('res_kom_transDetail/{id}', 'ModalController@res_kom_transDetail')->name('.res_kom_transDetail');
			Route::post('res_kom_transDetail_post/{id}', 'ModalController@res_kom_transDetail')->name('.res_kom_transDetail');
			Route::get('brand_detail/{id}', 'ModalController@brand_detail')->name('.brand_detail');
			Route::get('add_komplain/{id}', 'ModalController@add_komplain')->name('.add_komplain');
			Route::get('update_komplain/{id}', 'ModalController@update_komplain')->name('.update_komplain');
			Route::post('pick_produk_ship/{id}', 'ModalController@trans_pickProdukShip')->name('.pick_produk_ship');
			Route::get('add_resi/{id}', 'ModalController@add_resi')->name('.add_resi');
			Route::get('add_to_chart/{id}', 'ModalController@add_to_chart')->name('.add_to_chart');
		});
		Route::get('login', function(){return view('localapi.login');})->name('.login');
		Route::get('form_config', 'ModalController@formConfig')->name('.form_config');
		Route::get('addwishlist/{id}', 'ModalController@addwishlist')->name('.addwishlist');
		Route::get('pickaddress', 'ModalController@pickAddress')->name('.pickaddress');
		Route::get('addaddress', 'ModalController@addAddress')->name('.addaddress');
		Route::get('editaddress/{id}', 'ModalController@editaddress')->name('.editaddress');
		Route::get('addbank', 'ModalController@addbank')->name('.addbank');
		Route::get('editbank/{id}', 'ModalController@editbank')->name('.editbank');
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
Route::get('/about', 'Member\\FrontController@about')->name('about');
Route::get('/greenplaza_faq', 'Member\\FrontController@faq')->name('faq');
// helper
Route::group(['prefix' => 'helper', 'as' => 'helper'], function(){
	Route::get('/{function}/{admin}', function($function, $admin) {
    	return Helpers::$function($admin);
	});
	Route::get('/{function}', function($function) {
    	return Helpers::$function();
	});
});