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

//HOME
Route::get('/', 'member\\FrontController@index')->name('home');

Route::get('/tentang-greenplaza', 'member\\FrontController@about')->name('about') ;
Route::get('/cara-belanja', 'member\\FrontController@carabelanja')->name('cara-belanja') ;
Route::get('/cara-pembayaran', 'member\\FrontController@pembayaran')->name('cara-pembayaran') ;
Route::get('/aturan-penggunaan', 'member\\FrontController@aturan')->name('aturan') ;
Route::get('/syarat-ketentuan', 'member\\FrontController@syarat')->name('syarat') ;
Route::get('/alur-transaksi', 'member\\FrontController@alurtransaksi')->name('alur') ;

Route::get('/dashboard-member', 'member\\FrontController@dashboard');

// Route::get('/', function () {
//     return view('frontend.page.home');
// });

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
		Route::group(['prefix' => 'needapproval', 'as' => '.needapproval'], function () {
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
			Route::get('iklanbennerkhusus', 'Admin\\KonfigurasiController@iklanbanner')->name('.iklanbanner');
			Route::get('tambah_iklanbennerkhusus', 'Admin\\KonfigurasiController@tambah_iklanbanner')->name('.tambah_iklanbanner');

		//PROFILE GREENPLAZA
			//OFFICIAL EMAIL
			Route::get('officialemail', 'Admin\\KonfigurasiController@officialemail')->name('.officialemail');

		//SETTING AKUN
			//AKUN ADMIN
			Route::get('akunadmin', 'Admin\\KonfigurasiController@akunadmin')->name('.akunadmin');
			Route::get('tambah_akunadmin', 'Admin\\KonfigurasiController@tambah_akunadmin')->name('.tambah_akunadmin');
			Route::post('add', 'Admin\\KonfigurasiController@add')->name('.add');

			//PAGELIST
			Route::get('pagelist', 'Admin\\KonfigurasiController@pagelist')->name('.pagelist');
			Route::get('tambah_pagelist', 'Admin\\KonfigurasiController@tambah_pagelist')->name('.tambah_pagelist');

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
			Route::get('updatepassword/{id}', 'Admin\\KonfigurasiController@updatepass')->name('.updatepass');
			Route::post('changepassword/{id}', 'Admin\\KonfigurasiController@changepass')->name('.changepass');
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
	Route::group(['prefix' => 'member', 'as' => 'member', 'namespace' => 'Member'], function () {
		Route::get('/dashboard', 'FrontController@dashboard')->name('.dashboard');
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
			Route::get('/dropping/{id}', 'TransactionController@dropping')->name('.dropping');
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
			Route::get('/withdrawal', 'WalletController@withdrawal')->name('.withdrawal');
			Route::get('/transfer_cw', 'WalletController@transfer_cw')->name('.transfer_cw');
			Route::get('/transfer_rw', 'WalletController@transfer_rw')->name('.transfer_rw');
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
			Route::post('/buyer_address_update', 'UserController@buyer_address_update')->name('.buyer_address_update');
		});
		Route::get('/biodata', function(){return view('member.buyer.biodata');})->name('.biodata');
		// Pesan & Diskusi
		Route::group(['prefix' => 'produk', 'as' => '.produk'], function () {
			Route::group(['prefix' => 'discuss', 'as' => '.discuss'], function () {
				Route::get('/', 'Produk_discussController@index')->name('.index');
				Route::get('/create', 'Produk_discuss@create')->name('.create');
				Route::post('/store', 'Produk_discuss@store')->name('.store');
				Route::get('/destroy/{id}', 'Produk_discuss@destroy')->name('.destroy');
				Route::get('arsip/{id}', 'Produk_discuss@arsip')->name('.arsip');
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
			Route::post('/to_confirm/{$id}', 'HotlistController@to_confirm')->name('.to_confirm');
			Route::post('/to_cancel/{$id}', 'HotlistController@to_cancel')->name('.to_cancel');
			Route::get('/tagihan', 'HotlistController@tagihan')->name('.tagihan');
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
			Route::patch('/update/{id}', 'ProdukController@update')->name('.update');
			Route::delete('/destroy/{id}', 'ProdukController@destroy')->name('.destroy');
			Route::get('disabled/{id}', 'ProdukController@disabled')->name('.disabled');
		});
		// PIN Code
		Route::group(['prefix' => 'pincode', 'as' => '.pincode'], function () {
			Route::get('/buy_pincode', 'PincodeController@buy_pincode')->name('.buy_pincode');
			Route::post('/buy_pincode_store', 'PincodeController@buy_pincode_store')->name('.buy_pincode_store');
			Route::post('/to_confirm/{$id}', 'PincodeController@to_confirm')->name('.to_confirm');
			Route::post('/to_cancel/{$id}', 'PincodeController@to_cancel')->name('.to_cancel');
			Route::get('/list', function(){return view('member.pincode.history');})->name('.history');
			Route::get('/tagihan', 'PincodeController@tagihan')->name('.tagihan');
		});
		// Pasang Iklan
		Route::group(['prefix' => 'iklan', 'as' => '.iklan'], function () {
			Route::get('/beli_saldo', 'IklanController@beli_saldo')->name('.beli_saldo');
			Route::post('/beli_saldo_store', 'IklanController@beli_saldo_store')->name('.beli_saldo_store');
			Route::get('/history', function(){return view('member.iklan.history');})->name('.history');
			Route::get('/banner', function(){return view('member.iklan.banner');})->name('.banner');
			Route::get('/banner_khusus', function(){return view('member.iklan.banner_khusus');})->name('.banner_khusus');
			Route::get('/baris', function(){return view('member.iklan.baris');})->name('.baris');
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
			Route::get('/create', 'BankController@create')->name('.create');
			Route::post('/store', 'BankController@store')->name('.store');
			Route::get('/show/{id}', 'BankController@show')->name('.show');
			Route::get('/edit/{id}', 'BankController@edit')->name('.edit');
			Route::patch('/update/{id}', 'BankController@update')->name('.update');
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
		// Route::get('/cw_bonus', function(){return view('member.history_saldo.saldo_cw_bonus');})->name('.cw_bonus');
		// Route::get('/cw_trans', function(){return view('member.history_saldo.saldo_cw_transaksi');})->name('.cw_trans');
		// Route::get('/rw', function(){return view('member.history_saldo.saldo_rw');})->name('.rw');
		// Route::get('/withdrawal', function(){return view('member.withdrawal.index');})->name('.withdrawal');
		// Route::get('/beli_poin', function(){return view('member.hotlist.beli_poin');})->name('.beli_poin');
		// Route::get('/profil_user', function(){return view('member.pengaturan_profil.profil-user');})->name('.profil_user');
		// Route::get('/transfer_cw', function(){return view('member.transfer_cw.index');})->name('.transfer_cw');
	});
	Route::group(['prefix' => 'member/localapi', 'as' => 'member.localapi', 'namespace' => 'LocalApi'], function () {
		Route::group(['prefix' => 'tab', 'as' => '.tab'], function () {
		});
	});
});

// auth all
Route::get('/detail2/{slug}', 'member\\NewFrontController@detail')->name('detail2');
Route::get('/detail/{slug}', 'member\\FrontController@detail')->name('detail');
Route::get('/etalase/{user_store}', 'member\\FrontController@etalase')->name('etalase');
Route::get('/category', 'member\\FrontController@category')->name('category');
Route::get('/brand', 'member\\FrontController@brand')->name('brand');
Route::group(['middleware' => ['auth']], function () {
	Route::get('/member/home', 'Member\\HomeController@index')->name('member.home');
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
		Route::get('re_payment/{code}', 'MidtransController@re_payment')->name('.re_payment');
		Route::get('process', 'MidtransController@simple_process')->name('.simple_process');
		Route::post('process', 'MidtransController@process')->name('.process');
		// Route::post('done', 'MidtransController@done')->name('.done');
	});
	Route::group(['prefix' => 'content', 'as' => '.content'], function () {
		Route::post('choose-shipment/{id}', 'ContentController@choose_shipment')->name('.choose_shipment');
		Route::get('get_province/{id}', 'ContentController@get_province')->name('.get_province');
		Route::get('get_city/{id}', 'ContentController@get_city')->name('.get_city');
		Route::get('get_subdistrict/{id}', 'ContentController@get_subdistrict')->name('.get_subdistrict');
		Route::get('config_content', function(){return true;})->name('.config_content');
		Route::get('get_solusi/{id}', 'ContentController@get_solusi')->name('.get_solusi');
	});
	Route::group(['prefix' => 'modal', 'as' => '.modal'], function () {
		Route::get('login', function(){return view('localapi.login');})->name('.login');
		Route::get('form_config', 'ModalController@formConfig')->name('.form_config');
		Route::get('addwishlist/{id}', 'ModalController@addwishlist')->name('.addwishlist');
		Route::get('addchart/{id}', 'ModalController@addChart')->name('.addchart');
		Route::get('pickaddress', 'ModalController@pickAddress')->name('.pickaddress');
		Route::get('addaddress', 'ModalController@addAddress')->name('.addaddress');
		Route::get('trans_detail/{id}', 'ModalController@transDetail')->name('.trans_detail');
		Route::post('trans_detail_post/{id}', 'ModalController@transDetail')->name('.trans_detail_post');
		Route::get('res_kom_transDetail/{id}', 'ModalController@res_kom_transDetail')->name('.res_kom_transDetail');
		Route::post('res_kom_transDetail_post/{id}', 'ModalController@res_kom_transDetail')->name('.res_kom_transDetail');
		Route::get('brand_detail/{id}', 'ModalController@brand_detail')->name('.brand_detail');
		Route::get('add_komplain/{id}', 'ModalController@add_komplain')->name('.add_komplain');
		Route::get('update_komplain/{id}', 'ModalController@update_komplain')->name('.update_komplain');
		Route::post('pick_produk_ship/{id}', 'ModalController@trans_pickProdukShip')->name('.pick_produk_ship');
		Route::get('add_resi/{id}', 'ModalController@add_resi')->name('.add_resi');
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
