<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trans_detail;
use App\Models\Produk;
use App\User;
use App\Role;
use Session;
use Carbon\Carbon;

class MonitoringController extends Controller
{
//LAPORAN
    public function laporan (Request $request) 
    {   
    	$value1 = $request->tglawal;
    	$value2 = $request->tglakir;
        $detail = Trans_detail::orderBy('created_at', 'DESC')->paginate(10);
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			->whereBetween('created_at', [$value1, $value2])
		    			->paginate(10);
                        // dd($detail);

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
                ->where('trans_detail_transfer_date', '!='. 'null')
                ->paginate(10);
                // dd($detail);
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			->whereBetween('created_at', [$value1, $value2])
		    			->where('trans_detail_transfer_date', '!=', 'null')
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
                ->where('trans_detail_send_date', '!=', 'null')
                ->paginate(10);
                // dd($detail);
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			->whereBetween('created_at', [$value1, $value2])
		    			->where('trans_detail_send_date', '!=', 'null')
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
                ->where('trans_detail_drop_date', '!=', 'null')
                ->paginate(10);
                // dd($detail);
    	if ($value1 || $value2) {
    		if ($value2 >= $value1) {
		    	$detail = Trans_detail::orderBy('created_at', 'DESC')
		    			->where('trans_detail_drop_date', '!=', 'null')
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

//PROFIT
    public function profit ()
    {
        return view('admin.monitoring.profit.profit');
    }

    public function profit_detail ()
    {
        return view('admin.monitoring.profit.detail');
    }

//WALLET
    public function wallet_sellerlist ()
    {
        $users = Role::where('name', 'member')->first()->users;
        // dd($users);
        $seller = $users->where('user_store', '!=', 'null')->first();
        // dd($seller);
        return view('admin.monitoring.wallet.wallet_sellerlist', compact('seller'));
    }

    public function wallet_memberlist ()
    {
        $users = Role::where('name', 'member')->first()->users;
        // dd($users); die();
        return view('admin.monitoring.wallet.wallet_memberlist', compact('users'));
    }

//LOG_ACTIVITY
    public function log ()
    {
        return view('admin.monitoring.log_activity.activity');
    }


}
