<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Trans;
use App\Models\Trans_detail;
use App\Models\Trans_gln;
use App\Http\Controllers\Controller;
use FunctionLib;
use App\User;
use Auth;


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

     public function listsaldo_admin ()
    {
        $search = \Request::get('search');
        $where = "trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".(2).")";
        $trans = Trans::where('trans_payment_id', '=', 3)
                ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_trans_id', '=', 'sys_trans.id')
                ->whereRaw($where)
                ->where('trans_is_paid', 1)
                ->where('trans_detail_status', 6)
                ->sum('trans_amount_total');
        // $trans = Trans::where('trans_payment_id', '=', 3)->where('trans_is_paid', 1)->pluck('id')->toArray();
        // dd($trans);
        $masedi = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereRaw($where)
            ->whereHas('trans', function($query){
                $query->where('sys_trans.trans_payment_id','=',3);
                return $query;
            })
            ->whereHas('trans', function($query){
                $query->where('sys_trans.trans_is_paid','=',1);
                return $query;
            })
            ->where('trans_detail_status', '!=', 6 )
            ->where('trans_detail_is_cancel', '!=', 1 )
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
            // ->sum('trans_detail_amount_total');
        // dd($masedi);
        // dd($trans);
        // die();
        return view('admin.masedi.saldo_admin_masedi', compact('masedi', 'trans'));
    }

     public function listsaldo_admin_cancel ()
    {
        $search = \Request::get('search');
        $where = "trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".(2).")";
        $trans = Trans::where('trans_payment_id', '=', 3)
                ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_trans_id', '=', 'sys_trans.id')
                ->whereRaw($where)
                ->where('trans_is_paid', 1)
                ->where('trans_detail_status', 6)
                ->sum('trans_amount_total');
        // $trans = Trans::where('trans_payment_id', '=', 3)->where('trans_is_paid', 1)->pluck('id')->toArray();
        // dd($trans);
        $masedi = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereRaw($where)
            ->whereHas('trans', function($query){
                $query->where('sys_trans.trans_payment_id','=',3);
                return $query;
            })
            ->whereHas('trans', function($query){
                $query->where('sys_trans.trans_is_paid','=',1);
                return $query;
            })
            ->where('trans_detail_is_cancel', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
            // ->sum('trans_detail_amount_total');
        // dd($masedi);
        // dd($trans);
        // die();
        return view('admin.masedi.saldo_cancel_admin_masedi', compact('masedi', 'trans'));
    }

     public function listsaldo_admin_dropping ()
    {
        $search = \Request::get('search');
        $where = "trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".(2).")";
        $trans = Trans::where('trans_payment_id', '=', 3)
                ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_trans_id', '=', 'sys_trans.id')
                ->whereRaw($where)
                ->where('trans_is_paid', 1)
                ->where('trans_detail_status', 6)
                ->sum('trans_amount_total');
        // $trans = Trans::where('trans_payment_id', '=', 3)->where('trans_is_paid', 1)->pluck('id')->toArray();
        // dd($trans);
        $masedi = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereRaw($where)
            ->whereHas('trans', function($query){
                $query->where('sys_trans.trans_payment_id','=',3);
                return $query;
            })
            ->where('trans_detail_status', 6)
            ->whereHas('trans', function($query){
                $query->where('sys_trans.trans_is_paid','=',1);
                return $query;
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
            // ->sum('trans_detail_amount_total');
        // dd($masedi);
        // dd($trans);
        // die();
        return view('admin.masedi.saldo_dropping_admin_masedi', compact('masedi', 'trans'));
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
        $trans = Trans::where('trans_payment_id', '=', 4)
            ->whereNotIn('trans_code', function ($query) {
                $query->select('trans_voucher_trans')
                    ->from('sys_trans_voucher');
                return $query;
            })
            ->where('trans_is_paid', '=', 1)
            ->pluck('id')
            ->toArray();
        $gln = Trans_detail::where('trans_detail_trans_id', 'like', '%'.$search.'%')
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
        $trans = Trans::where('trans_payment_id', '=', 4)
            ->whereNotIn('trans_code', function ($query) {
                $query->select('trans_voucher_trans')
                    ->from('sys_trans_voucher');
                return $query;
            })
            ->where('trans_is_paid', '=', 1)
            ->pluck('id')
            ->toArray();
        $gln = Trans_detail::where('trans_detail_trans_id', 'like', '%'.$search.'%')
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
        $trans = Trans::where('trans_payment_id', '=', 4)
            ->whereNotIn('trans_code', function ($query) {
                $query->select('trans_voucher_trans')
                    ->from('sys_trans_voucher');
                return $query;
            })
            ->where('trans_is_paid', '=', 1)
            ->pluck('id')
            ->toArray();
        $gln = Trans_detail::where('trans_detail_trans_id', 'like', '%'.$search.'%')
            ->whereIn('trans_detail_trans_id', $trans)
            ->where('trans_detail_is_cancel', 1)
            ->where('trans_detail_status', 3, 4)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $url = FunctionLib::gln('compare',[])['data'];
        // dd($gln);
        return view('admin.masedi.gln.list_gln_cancel', compact('gln', 'url'));
    }
}
