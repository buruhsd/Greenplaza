<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Trans;
use App\Http\Controllers\Controller;

class MasediController extends Controller
{
//MASEDI
    public function list ()
    {
        $search = \Request::get('search');
    	$masedi = Trans::where('trans_code', 'like', '%'.$search.'%')->where('trans_is_paid', '=', 1)->where('trans_payment_id', '=', 3)->orderBy('created_at', 'DESC')->paginate(10);
    	// dd($masedi);
    	return view('admin.masedi.list_masedi', compact('masedi'));
    }
    public function listsaldo ()
    {
    	return view('admin.masedi.saldo_masedi');
    }

//GLN
    public function list_gln_paid ()
    {
        $search = \Request::get('search');
        $gln = Trans::where('trans_code', 'like', '%'.$search.'%')->where('trans_is_paid', '=', 1)->where('trans_payment_id', '=', 4)->orderBy('created_at', 'DESC')->paginate(10);
        // dd($masedi);
        return view('admin.masedi.list_gln', compact('gln'));
    }
    public function list_gln_notpaid ()
    {
        $search = \Request::get('search');
        $gln = Trans::where('trans_code', 'like', '%'.$search.'%')->where('trans_is_paid', '=', 0)->where('trans_payment_id', '=', 4)->orderBy('created_at', 'DESC')->paginate(10);
        // dd($masedi);
        return view('admin.masedi.list_gln', compact('gln'));
    }
}
