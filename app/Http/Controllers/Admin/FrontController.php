<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trans_detail;
use App\Models\Trans;
use App\User;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return "Admin Bos";exit;
        // return view('home');
    }

//DASBOARD
    public function dashboard(){
    //SELLER
        //detail
        $userseller = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->where('user_store', '!=', null)->pluck('id')->toArray();
        $transseller = Trans::where('trans_user_id', $userseller)->pluck('id')->toArray();
        $detailsellerorder = Trans_detail::whereIn('trans_detail_trans_id', $transseller)
                                            ->where('trans_detail_status', '=', 1)->get();
        $detailsellertransfer = Trans_detail::whereIn('trans_detail_trans_id', $transseller)
                                            ->where('trans_detail_status', '=', 2)->get();
        $detailsellerseller = Trans_detail::whereIn('trans_detail_trans_id', $transseller)
                                            ->where('trans_detail_status', '=', 3)->get();
        $detailsellerpacking = Trans_detail::whereIn('trans_detail_trans_id', $transseller)
                                            ->where('trans_detail_status', '=', 4)->get();
        $detailsellershipping = Trans_detail::whereIn('trans_detail_trans_id', $transseller)
                                            ->where('trans_detail_status', '=', 5)->get(); 
        $detailsellerdropping = Trans_detail::whereIn('trans_detail_trans_id', $transseller)
                                            ->where('trans_detail_status', '=', 6)->get();  

        //hotlist
        $userseller = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->where('user_store', '!=', null)->pluck('id')->toArray();
        $hotsellerbaru = Trans_detail::whereIn('trans_detail_trans_id', $transseller)
                                            ->where('trans_detail_status', '=', 0)->get();
        $hotsellerkonf = Trans_detail::whereIn('trans_detail_trans_id', $transseller)
                                            ->where('trans_detail_status', '=', 1)->get();
        $hotsellerbatal = Trans_detail::whereIn('trans_detail_trans_id', $transseller)
                                            ->where('trans_detail_status', '=', 2)->get();
        $hotsellerapprove = Trans_detail::whereIn('trans_detail_trans_id', $transseller)
                                            ->where('trans_detail_status', '=', 3)->get();
        $hotsellerditolak = Trans_detail::whereIn('trans_detail_trans_id', $transseller)
                                            ->where('trans_detail_status', '=', 4)->get();               
        return view('admin.dashboard.dashboard', 
            compact(
                'userseller', 
                'transseller', 
                'detailsellerorder', 
                'detailsellertransfer',
                'detailsellerseller',
                'detailsellerpacking',
                'detailsellershipping',
                'detailsellerdropping',
                'hotsellerbaru',
                'hotsellerkonf',
                'hotsellerbatal',
                'hotsellerapprove',
                'hotsellerditolak'
            ));
    }

    public function dashboarddetail ()
    {
        $search = \Request::get('search');
        $userseller = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->where('user_store', '!=', null)->pluck('id')->toArray();
        $transseller = Trans::where('trans_user_id', $userseller)->pluck('id')->toArray();
        $detailseller = Trans_detail::where('id', 'like', '%'.$search.'%')->whereIn('trans_detail_trans_id', $transseller)->get();

        return view('admin.dashboard.seller.detail', compact('userseller', 'transseller', 'detailseller'));
    }
    public function changepassword_seller (Request $request, $id)
    {
        $users = User::find($id);
        // dd($users);
        return view('admin.dashboard.seller.resetpassseller', compact('users'));
    }
    public function password_seller (Request $request, $id)
    {
            $value = $request->value;
            $users = User::find($id);
            if ($value == $request->password){
                $users->password = bcrypt($request->password);
                $users->save();
                Session::flash("flash_notification", [
                            "level"=>"success",
                            "message"=>"Password Berhasil Diubah."
                ]);
            } else {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Password Salah"
                ]);
            }
        return redirect()->back();
    }


    /**
    *
    *
    */
    public function category()
    {

        return view('home');
    }

     public function email_sender()
    {

        return view('admin.email-sender.email_sender');
    }

    public function res_kom()
    {

        return view('admin.resolusi_komplain.res_kom');
    }

    public function live_chat()
    {
        return view('admin.transaksi.laporan_transaksi');
    }
}
