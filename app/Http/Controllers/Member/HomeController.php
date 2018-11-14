<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use FunctionLib;
use App\Models\Produk;

class HomeController extends Controller
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
    public function index()
    {
        $perPage = 8;
        $data['produk_newest'] = Produk::skip(0)->take($perPage)->orderBy('created_at', 'DESC')->get();
        return view('layouts.home', $data);
    }
}
