<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return "Admin Bos";exit;
        // return view('home');
    }

    public function dashboard(){
        return view('admin.dashboard.dashboard');
    }


    /**
    *
    *
    */
    public function category()
    {

        return view('home');
    }

     public function email_sender()
    {

        return view('admin.email-sender.email_sender');
    }

    public function res_kom()
    {

        return view('admin.resolusi_komplain.res_kom');
    }

    public function live_chat()
    {
        return view('admin.transaksi.laporan_transaksi');
    }
}
