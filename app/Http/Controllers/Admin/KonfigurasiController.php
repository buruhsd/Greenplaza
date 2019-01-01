<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KonfigurasiController extends Controller
{
//SETTING HARGA
	//REG SELLER
    public function regseller ()
    {
    	return view('admin.konfigurasi.settingharga.regseller.regseller');
    }
    public function tambah_regseller ()
    {
    	return view('admin.konfigurasi.settingharga.regseller.tambah');
    }

	//HARGA IKLAN
    public function hargaiklan ()
    {
    	return view('admin.konfigurasi.settingharga.hargaiklan.hargaiklan');
    }

	//HARGA BELI SALDO
    public function hargabeli ()
    {
    	return view('admin.konfigurasi.settingharga.hargabelisaldo.hargabeli');
    }
    public function tambah_hargabeli ()
    {
    	return view('admin.konfigurasi.settingharga.hargabelisaldo.tambah');
    }
    public function update_hargabeli ()
    {
    	return view('admin.konfigurasi.settingharga.hargabelisaldo.update');
    }

//SETTING IKLAN
    //IKLAN SLIDER
    public function iklanslider ()
    {
    	return view('admin.konfigurasi.settingiklan.iklanslider.iklanslider');
    }
    public function tambah_iklanslider ()
    {
    	return view('admin.konfigurasi.settingiklan.iklanslider.tambah');
    }

    //IKLAN BANNER KHUSUS
    public function iklanbanner ()
    {
    	return view('admin.konfigurasi.settingiklan.iklanbannerkhusus.iklanbanner');
    }
    public function tambah_iklanbanner ()
    {
    	return view('admin.konfigurasi.settingiklan.iklanbannerkhusus.tambah');
    }

//PROFILE GREENPLAZA
    //OFFICIAL EMAIL
    public function officialemail ()
    {
    	return view('admin.konfigurasi.profilegreenplaza.officialemail.officialemail');
    }

//SETTING AKUN
    //AKUN ADMIN
    public function akunadmin ()
    {
    	return view('admin.konfigurasi.settingakun.akunadmin.akunadmin');
    }
}
