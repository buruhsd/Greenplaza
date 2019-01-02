<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;

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
    public function tambah_akunadmin ()
    {
    	return view('admin.konfigurasi.settingakun.akunadmin.tambah');
    }
    public function add (Request $request)
    {
    	$users = User::pluck('name')->toArray();
    	// dd($users);
    	$value = $request->value;
    	if ($value != $users){
    		Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"Nama User Tidak Terdaftar."
            ]);
    	}else {
    		
    	}
    	return redirect()->back();
    }

    //PAGELIST
    public function pagelist ()
    {
    	return view('admin.konfigurasi.settingakun.pagelist.pagelist');
    }
    public function tambah_pagelist ()
    {
    	return view('admin.konfigurasi.settingakun.pagelist.tambah');
    }

    //UPDATEPASS
    public function updatepass (Request $request, $id)
    {
    	$users = User::find($id);
    	return view('admin.konfigurasi.settingakun.updatepass.updatepass', compact('users'));
    }
    public function changepass (Request $request, $id)
    {
    	$value = $request->value;
        $users = User::find($id);
        if ($value == $request->password){
            $users->password = bcrypt($request->password);
            $users->save();
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Password Berhasil Diubah."
            ]);
        } else {
            Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"Password Salah"
            ]);
        }
    return redirect()->back();
    }
}
