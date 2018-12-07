<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trans_detail;
use App\Models\Produk;
use App\User;

class MonitoringController extends Controller
{
    public function laporan (Request $request) 
    {
    	$value1 = $request->tglawal;
    	$value2 = $request->tglakir;
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			->whereBetween('created_at', [$value1, $value2])
		    			->paginate(10);

		    	return view('admin.monitoring.laporan', compact('detail'));
	    	} elseif ($value1 >= $value2) {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Tanggal Mulai Lebih Dari Tanggal Sampai"
                        ]);
	            return redirect()->back();
	        }
	    } 
    }

    public function laporan_list_transfer() 
    {
    	$value1 = $request->tglawal;
    	$value2 = $request->tglakir;
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			->whereBetween('created_at', [$value1, $value2])
		    			->where('trans_detail_transfer_date', != null)
		    			->paginate(10);
		    	return view('admin.monitoring.laporan', compact('detail'));
		    } elseif ($value1 >= $value2) {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Tanggal Mulai Lebih Dari Tanggal Sampai"
                        ]);
	            return redirect()->back();
	        }
	    }
    }

    public function laporan_list_dikirim() 
    {
    	$value1 = $request->tglawal;
    	$value2 = $request->tglakir;
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			->whereBetween('created_at', [$value1, $value2])
		    			->where('trans_detail_send_date', != null)
		    			->paginate(10);
		    	return view('admin.monitoring.laporan', compact('detail'));
		     } elseif ($value1 >= $value2) {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Tanggal Mulai Lebih Dari Tanggal Sampai"
                        ]);
	            return redirect()->back();
	        }
	    }
    }

    public function laporan_list_sampai() 
    {
    	$value1 = $request->tglawal;
    	$value2 = $request->tglakir;
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			->where('trans_detail_drop_date', != null)
		    			->paginate(10);
		    	return view('admin.monitoring.laporan', compact('detail'));
    		} elseif ($value1 >= $value2) {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Tanggal Mulai Lebih Dari Tanggal Sampai"
                        ]);
	            return redirect()->back();
	        }
	    }
	}
