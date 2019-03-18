<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trans_detail;
use App\Models\Produk;
use App\Models\Activity;
use App\Models\Wallet;
use App\Models\Withdrawal;
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
        // $users = User::find($id);
        $users = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->where('user_store', '!=', null)->get();
        // dd($users);
        // $users = Role::where('name', 'member')->where('user_store', '!=', 'null')->first()->users;
        // // dd($users);
        // $seller = $users->where('user_store', '!=', 'null')->first();
        // // dd($seller);
        return view('admin.monitoring.wallet.wallet_sellerlist', compact('users'));
    }
    public function editsaldoseller (Request $request, $id)
    {
        $users = User::find($id);
        $cw = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '1')->first();
        // dd($cw);
        $rw = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '2')->first();
        $transaksi = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '3')->first();
        $iklan = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '4')->first();
        $pincode = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '5')->first();

        return view('admin.monitoring.wallet.editsaldoseller', compact('users', 'cw', 'rw', 'transaksi', 'iklan', 'pincode'));
    }
    public function editsaldomember (Request $request, $id)
    {
        $users = User::find($id);
        $cw = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '1')->first();
        // dd($cw);
        $rw = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '2')->first();
        $transaksi = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '3')->first();
        $iklan = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '4')->first();
        $pincode = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '5')->first();

        return view('admin.monitoring.wallet.editsaldomember', compact('users', 'cw', 'rw', 'transaksi', 'iklan', 'pincode'));
    }
    public function editsaldoseller_cw (Request $request, $id)
    {
        $users = User::find($id);
        $cw = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '1')->first();
        $cw->wallet_ballance = $request->wallet_ballance;
        $cw->save();
        Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Saldo Berhasil di Ubah."
            ]);
        return redirect()->back();

    }
    public function editsaldoseller_rw (Request $request, $id)
    {
        $users = User::find($id);
        $cw = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '2')->first();
        $cw->wallet_ballance = $request->wallet_ballance;
        $cw->save();
        Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Saldo Berhasil di Ubah."
            ]);
        return redirect()->back();

    }
    public function editsaldoseller_transaksi (Request $request, $id)
    {
        $users = User::find($id);
        $cw = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '3')->first();
        $cw->wallet_ballance = $request->wallet_ballance;
        $cw->save();
        Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Saldo Berhasil di Ubah."
            ]);
        return redirect()->back();

    }
    public function editsaldoseller_iklan (Request $request, $id)
    {
        $users = User::find($id);
        $cw = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '4')->first();
        $cw->wallet_ballance = $request->wallet_ballance;
        $cw->save();
        Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Saldo Berhasil di Ubah."
            ]);
        return redirect()->back();

    }
    public function editsaldoseller_pincode (Request $request, $id)
    {
        $users = User::find($id);
        $cw = Wallet::where('wallet_user_id', $users->id)->where('wallet_type', '=', '5')->first();
        $cw->wallet_ballance = $request->wallet_ballance;
        $cw->save();
        Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Saldo Berhasil di Ubah."
            ]);
        return redirect()->back();

    }

    public function wallet_memberlist (Request $request)
    {
        $where = 1;
        if(!empty($request->get('nama'))){
            $name = $request->get('nama');
            $where .= ' AND users.name LIKE "%'.$name.'%"';
        }
        $users = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })->whereRaw($where)->get();
        // dd($users);
        // $users = Role::where('name', 'member')->first()->users;
        // dd($users); die();
        return view('admin.monitoring.wallet.wallet_memberlist', compact('users'));
    }

//LOG_ACTIVITY
    public function log ()
    {
        $log = Activity::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.monitoring.log_activity.activity', compact('log'));
    }

    public function log_wd ()
    {
        $log_wd = Withdrawal::where('withdrawal_wallet_type', 1)->paginate(10);
        return view('admin.monitoring.withdrawal.log_wd', compact('log_wd'));
    }


}
