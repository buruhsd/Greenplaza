<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Trans;
use App\Models\Trans_detail;
use App\Models\Trans_gln;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use FunctionLib;
use App\User;
use Auth;


class LogController extends Controller
{
    public function transaksi_lain(Request $request){
        // $sum_amount = FunctionLib::sum_amount();
        $where = 1;
        $where .= " AND trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id != ".(2).")";

        // metode pembayaran
        $pym = Payment::where('payment_status', 1)->whereIn('id', [3, 5, 6])->orderBy('id')->pluck('id')->first();
        if($request->has('payment_type')){
            $pym = Payment::where('payment_kode', $request->payment_type)->pluck('id')->first(); 
        }
        $pymt[] = $pym;
        $data['payment_type'] = Payment::where('payment_status', 1)->whereIn('id', [3, 5, 6])->orderBy('id')->get();

        $data['sum'] = Trans_detail::whereRaw($where)
            ->whereHas('trans', function($query) use ($pymt){
                $query->whereIn('sys_trans.trans_payment_id', $pymt);
                $query->where('sys_trans.trans_is_paid','=',1);
                return $query;
            })
            ->where('trans_detail_status', '=', 6 )
            ->where('trans_detail_is_cancel', '!=', 1 )
            ->sum('trans_detail_amount_total');

        // kode transaksi
        if($request->has('code')){
            $where .= ' AND trans_code LIKE "%'.$request->code.'%"';
        }

        // status transaksi
        $arr_status = [
            'process' => 'trans_detail_status != 6 AND trans_detail_is_cancel != 1',
            'dropping' => 'trans_detail_status = 6 AND trans_detail_is_cancel != 1',
            'cancel' => 'trans_detail_is_cancel = 1',
        ];
        $w_status = ' AND '.$arr_status['process']; 
        if($request->has('status')){
            $w_status = ' AND '.$arr_status[$request->status]; 
        }
        $where .= $w_status; 

        $data['list'] = Trans_detail::whereRaw($where)
            ->whereHas('trans', function($query) use ($pymt){
                $query->whereIn('sys_trans.trans_payment_id', $pymt);
                $query->where('sys_trans.trans_is_paid','=',1);
                return $query;
            })
            // ->where('trans_detail_status', '!=', 6 )
            // ->where('trans_detail_is_cancel', '!=', 1 )
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
     
        return view('admin.log_transaksi.log_transaksi_lain', $data);
    }
    public function transaksi_lain_admin(Request $request){
        // $sum_amount = FunctionLib::sum_amount();
        $where = 1;
        $where .= " AND trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".(2).")";

        // metode pembayaran
        $pym = Payment::where('payment_status', 1)->whereIn('id', [3, 5, 6])->orderBy('id')->pluck('id')->first();
        if($request->has('payment_type')){
            $pym = Payment::where('payment_kode', $request->payment_type)->pluck('id')->first(); 
        }
        $pymt[] = $pym;
        $data['payment_type'] = Payment::where('payment_status', 1)->whereIn('id', [3, 5, 6])->orderBy('id')->get();

        $data['sum'] = Trans_detail::whereRaw($where)
            ->whereHas('trans', function($query) use ($pymt){
                $query->whereIn('sys_trans.trans_payment_id', $pymt);
                $query->where('sys_trans.trans_is_paid','=',1);
                return $query;
            })
            ->where('trans_detail_status', '=', 6 )
            ->where('trans_detail_is_cancel', '!=', 1 )
            ->sum('trans_detail_amount_total');

        // kode transaksi
        if($request->has('code')){
            $where .= ' AND trans_code LIKE "%'.$request->code.'%"';
        }

        // status transaksi
        $arr_status = [
            'process' => 'trans_detail_status != 6 AND trans_detail_is_cancel != 1',
            'dropping' => 'trans_detail_status = 6 AND trans_detail_is_cancel != 1',
            'cancel' => 'trans_detail_is_cancel = 1',
        ];
        $w_status = ' AND '.$arr_status['process']; 
        if($request->has('status')){
            $w_status = ' AND '.$arr_status[$request->status]; 
        }
        $where .= $w_status; 

        $data['list'] = Trans_detail::whereRaw($where)
            ->whereHas('trans', function($query) use ($pymt){
                $query->whereIn('sys_trans.trans_payment_id', $pymt);
                $query->where('sys_trans.trans_is_paid','=',1);
                return $query;
            })
            // ->where('trans_detail_status', '!=', 6 )
            // ->where('trans_detail_is_cancel', '!=', 1 )
            ->orderBy('created_at', 'DESC')
            ->paginate(5);
     
        return view('admin.log_transaksi.log_transaksi_lain_admin', $data);
    }
}
