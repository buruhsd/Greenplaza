<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trans_detail;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function penjualan(Request $request, $status)
    {
        $where = '1';
        // status transaksi
        $arr_status = [
            'process' => 'trans_detail_status != 6 AND trans_detail_is_cancel != 1',
            'done' => 'trans_detail_status = 6 AND trans_detail_is_cancel != 1',
            'cancel' => 'trans_detail_is_cancel = 1'
        ];
        $w_status = ' AND '.$arr_status['process']; 
        if($request->has('status')){
            $w_status = ' AND '.$arr_status[$status]; 
        }
        $where .= $w_status;

        $asset = asset('assets/images/product');
        $data = Trans_detail::whereRaw($where)
                ->leftJoin('sys_produk', 'sys_produk.id', '=', 'sys_trans_detail.trans_detail_produk_id')
                ->select('sys_trans_detail.*', DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as produk'))
                ->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }
    public function pembelian(Request $request, $status)
    {
        $where = '1';
        // status transaksi
        $arr_status = [
            'process' => 'trans_detail_status != 6 AND trans_detail_is_cancel != 1',
            'done' => 'trans_detail_status = 6 AND trans_detail_is_cancel != 1',
            'cancel' => 'trans_detail_is_cancel = 1'
        ];
        $w_status = ' AND '.$arr_status['process']; 
        if($request->has('status')){
            $w_status = ' AND '.$arr_status[$status]; 
        }
        $where .= $w_status;

        $asset = asset('assets/images/product');
        $data = Trans_detail::whereRaw($where)
                ->leftJoin('sys_produk', 'sys_produk.id', '=', 'sys_trans_detail.trans_detail_produk_id')
                ->select('sys_trans_detail.*', DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as produk'))
                ->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }
}
