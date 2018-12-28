<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KonfigurasiController extends Controller
{
    public function regseller ()
    {
    	return view('admin.konfigurasi.settingharga.regseller.regseller');
    }
}
