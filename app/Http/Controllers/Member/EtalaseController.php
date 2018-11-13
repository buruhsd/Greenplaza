<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EtalaseController extends Controller
{
    public function etalase()
    {
        return view('frontend.etalase');
    }
    
}
