<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Produk;
use Session;
use Auth;

class ChartController extends Controller
{
    public function chart()
    {
        return view('frontend.chart');
    }
    
}
