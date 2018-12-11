<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trans_detail;
use App\Models\Produk;
use App\User;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    public function laporan (Request $request) 
    {
    	$value1 = Carbon::parse($request->tglawal)->toDateString();
    	$value2 = Carbon::parse($request->tglakir)->toDateString();
        $detail = Trans_detail::orderBy('created_at', 'DESC')->paginate(10);
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			// ->whereBetween('created_at', [$value1, $value2])
                        ->where('created_at', '>=', $value1)
                        ->where('created_at', '<=', $value2)
		    			->paginate(10);
                        dd($detail);

                return view('admin.monitoring.laporan.laporan', compact('detail')); 
	    	} elseif ($value1 >= $value2) {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Tanggal Mulai Lebih Dari Tanggal Sampai"
                        ]);
	            return redirect()->back();
	        }
	    }
        return view('admin.monitoring.laporan.laporan', compact('detail')); 
    }

    public function laporan_list_transfer(Request $request) 
    {
    	$value1 = $request->tglawal;
    	$value2 = $request->tglakir;
        $detail = Trans_detail::orderBy('created_at', 'DESC')
                ->where('trans_detail_transfer_date', '!=null')
                ->paginate(10);
                // dd($detail);
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			->whereBetween('created_at', [$value1, $value2])
		    			->where('trans_detail_transfer_date')
		    			->paginate(10);
		    	return view('admin.monitoring.laporan.laporan_listtransfer', compact('detail'));
		    } elseif ($value1 >= $value2) {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Tanggal Mulai Lebih Dari Tanggal Sampai"
                        ]);
	            return redirect()->back();
	        }
	    }
        return view('admin.monitoring.laporan.laporan_listtransfer', compact('detail'));
    }

    public function laporan_list_dikirim(Request $request) 
    {
    	$value1 = $request->tglawal;
    	$value2 = $request->tglakir;
        $detail = Trans_detail::orderBy('created_at', 'DESC')
                ->where('trans_detail_send_date', '!=null')
                ->paginate(10);
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			->whereBetween('created_at', [$value1, $value2])
		    			->where('trans_detail_send_date')
		    			->paginate(10);
		    	return view('admin.monitoring.laporan.laporan_listdikirim', compact('detail'));
		     } elseif ($value1 >= $value2) {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Tanggal Mulai Lebih Dari Tanggal Sampai"
                        ]);
	            return redirect()->back();
	        }
	    }
        return view('admin.monitoring.laporan.laporan_listdikirim', compact('detail'));
    }

    public function laporan_list_sampai(Request $request) 
    {
    	$value1 = $request->tglawal;
    	$value2 = $request->tglakir;
        $detail = Trans_detail::orderBy('created_at', 'DESC')
                ->where('trans_detail_drop_date', '!=null')
                ->paginate(10);
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			->where('trans_detail_drop_date')
		    			->paginate(10);
		    	return view('admin.monitoring.laporan.laporan_listsampai', compact('detail'));
    		} elseif ($value1 >= $value2) {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Tanggal Mulai Lebih Dari Tanggal Sampai"
                        ]);
	            return redirect()->back();
	        }
	    }
        return view('admin.monitoring.laporan.laporan_listsampai', compact('detail'));
	}


}
