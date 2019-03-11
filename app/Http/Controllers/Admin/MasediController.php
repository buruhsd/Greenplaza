<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Trans;
use App\Models\Trans_detail;
use App\Models\Trans_gln;
use App\Http\Controllers\Controller;
use FunctionLib;
use App\User;


class MasediController extends Controller
{
//MASEDI
    public function list ()
    {
        $search = \Request::get('search');
        $trans = Trans::where('trans_payment_id', '=', 3)->pluck('id')->toArray();
    	$masedi = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereIn('trans_detail_trans_id', $trans)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    	// dd($masedi);
    	return view('admin.masedi.list_masedi', compact('masedi'));
    }
    public function list_done ()
    {
        $search = \Request::get('search');
        $trans = Trans::where('trans_payment_id', '=', 3)->pluck('id')->toArray();
        $masedi = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereIn('trans_detail_trans_id', $trans)
            ->where('trans_detail_status', 6)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        // dd($masedi);
        return view('admin.masedi.list_masedi_done', compact('masedi'));
    }
    public function list_cancel ()
    {
        $search = \Request::get('search');
        $trans = Trans::where('trans_payment_id', '=', 3)->pluck('id')->toArray();
        $masedi = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereIn('trans_detail_trans_id', $trans)
            ->where('trans_detail_is_cancel', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        // dd($masedi);
        return view('admin.masedi.list_masedi_cancel', compact('masedi'));
    }

//GLN
    public function list_gln_paid ()
    {
        $search = \Request::get('search');
        $trans = Trans::where('trans_payment_id', '=', 4)->pluck('id')->toArray();
        $gln = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereIn('trans_detail_trans_id', $trans)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $url = FunctionLib::gln('compare',[])['data'];
        // dd($gln);
        return view('admin.masedi.gln.list_gln', compact('gln', 'url'));
    }
    
    public function list_gln_done ()
    {
        $search = \Request::get('search');
        $trans = Trans::where('trans_payment_id', '=', 4)->pluck('id')->toArray();
        $gln = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereIn('trans_detail_trans_id', $trans)
            ->where('trans_detail_is_cancel', 0)
            ->where('trans_detail_status', 6)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $url = FunctionLib::gln('compare',[])['data'];
        // dd($gln);
        return view('admin.masedi.gln.list_gln_done', compact('gln', 'url'));
    }

    public function list_gln_cancel ()
    {
        $search = \Request::get('search');
        $trans = Trans::where('trans_payment_id', '=', 4)->pluck('id')->toArray();
        $gln = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereIn('trans_detail_trans_id', $trans)
            ->where('trans_detail_is_cancel', 1)
            ->where('trans_detail_status', 4)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $url = FunctionLib::gln('compare',[])['data'];
        // dd($gln);
        return view('admin.masedi.gln.list_gln_cancel', compact('gln', 'url'));
    }
}
