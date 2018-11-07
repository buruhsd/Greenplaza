<?php

namespace App\Http\Controllers\Member;

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
        return "Member Bos";exit;
        // return view('home');
    }

    /**
    *
    *
    */
    public function category()
    {

        return view('frontend.category');
    }

    public function detail()
    {

        return view('frontend.detail');
    }

    public function etalase()
    {

        return view('frontend.shop');
    }

    public function reg_seller()
    {

        return view('auth.register_green');
    }
}
