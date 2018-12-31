<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KonfigurasiController extends Controller
{
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
}
