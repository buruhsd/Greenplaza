<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trans_detail;
use App\Models\Trans_hotlist;
use App\Models\Trans_iklan;
use App\Models\Trans_pincode;
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
        //detail
        $userseller = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->where('user_store', '!=', null)->pluck('id')->toArray();

        $usermember = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->pluck('id')->toArray();

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

        $transmember = Trans::where('trans_user_id', $usermember)->pluck('id')->toArray();
        $detailmemberorder = Trans_detail::whereIn('trans_detail_trans_id', $transmember)
                                            ->where('trans_detail_status', '=', 1)->get();
        $detailmembertransfer = Trans_detail::whereIn('trans_detail_trans_id', $transmember)
                                            ->where('trans_detail_status', '=', 2)->get();
        $detailmemberseller = Trans_detail::whereIn('trans_detail_trans_id', $transmember)
                                            ->where('trans_detail_status', '=', 3)->get();
        $detailmemberpacking = Trans_detail::whereIn('trans_detail_trans_id', $transmember)
                                            ->where('trans_detail_status', '=', 4)->get();
        $detailmembershipping = Trans_detail::whereIn('trans_detail_trans_id', $transmember)
                                            ->where('trans_detail_status', '=', 5)->get(); 
        $detailmemberdropping = Trans_detail::whereIn('trans_detail_trans_id', $transmember)
                                            ->where('trans_detail_status', '=', 6)->get();  

        //hotlist
        $hotsellerbaru = Trans_hotlist::whereIn('trans_hotlist_user_id', $userseller)
                                            ->where('trans_hotlist_status', '=', 0)->get();
        $hotsellerkonf = Trans_hotlist::whereIn('trans_hotlist_user_id', $userseller)
                                            ->where('trans_hotlist_status', '=', 1)->get();
        $hotsellerbatal = Trans_hotlist::whereIn('trans_hotlist_user_id', $userseller)
                                            ->where('trans_hotlist_status', '=', 2)->get();
        $hotsellerapprove = Trans_hotlist::whereIn('trans_hotlist_user_id', $userseller)
                                            ->where('trans_hotlist_status', '=', 3)->get();
        $hotsellerditolak = Trans_hotlist::whereIn('trans_hotlist_user_id', $userseller)
                                            ->where('trans_hotlist_status', '=', 4)->get();

        $hotmemberbaru = Trans_hotlist::whereIn('trans_hotlist_user_id', $usermember)
                                            ->where('trans_hotlist_status', '=', 0)->get();
        $hotmemberkonf = Trans_hotlist::whereIn('trans_hotlist_user_id', $usermember)
                                            ->where('trans_hotlist_status', '=', 1)->get();
        $hotmemberbatal = Trans_hotlist::whereIn('trans_hotlist_user_id', $usermember)
                                            ->where('trans_hotlist_status', '=', 2)->get();
        $hotmemberapprove = Trans_hotlist::whereIn('trans_hotlist_user_id', $usermember)
                                            ->where('trans_hotlist_status', '=', 3)->get();
        $hotmemberditolak = Trans_hotlist::whereIn('trans_hotlist_user_id', $usermember)
                                            ->where('trans_hotlist_status', '=', 4)->get();

        //iklan
        $iklansellerbaru = Trans_iklan::whereIn('trans_iklan_user_id', $userseller)
                                            ->where('trans_iklan_status', '=', 0)->get();
        $iklansellerkonf = Trans_iklan::whereIn('trans_iklan_user_id', $userseller)
                                            ->where('trans_iklan_status', '=', 1)->get();
        $iklansellerbatal = Trans_iklan::whereIn('trans_iklan_user_id', $userseller)
                                            ->where('trans_iklan_status', '=', 2)->get();
        $iklansellerapprove = Trans_iklan::whereIn('trans_iklan_user_id', $userseller)
                                            ->where('trans_iklan_status', '=', 3)->get();
        $iklansellerditolak = Trans_iklan::whereIn('trans_iklan_user_id', $userseller)
                                            ->where('trans_iklan_status', '=', 4)->get();

        $iklanmemberbaru = Trans_iklan::whereIn('trans_iklan_user_id', $usermember)
                                            ->where('trans_iklan_status', '=', 0)->get();
        $iklanmemberkonf = Trans_iklan::whereIn('trans_iklan_user_id', $usermember)
                                            ->where('trans_iklan_status', '=', 1)->get();
        $iklanmemberbatal = Trans_iklan::whereIn('trans_iklan_user_id', $usermember)
                                            ->where('trans_iklan_status', '=', 2)->get();
        $iklanmemberapprove = Trans_iklan::whereIn('trans_iklan_user_id', $usermember)
                                            ->where('trans_iklan_status', '=', 3)->get();
        $iklanmemberditolak = Trans_iklan::whereIn('trans_iklan_user_id', $usermember)
                                            ->where('trans_iklan_status', '=', 4)->get();

        //pincode
        $pinsellerbaru = Trans_pincode::whereIn('trans_pincode_user_id', $userseller)
                                            ->where('trans_pincode_status', '=', 0)->get();
        $pinsellerkonf = Trans_pincode::whereIn('trans_pincode_user_id', $userseller)
                                            ->where('trans_pincode_status', '=', 1)->get();
        $pinsellerbatal = Trans_pincode::whereIn('trans_pincode_user_id', $userseller)
                                            ->where('trans_pincode_status', '=', 2)->get();
        $pinsellerapprove = Trans_pincode::whereIn('trans_pincode_user_id', $userseller)
                                            ->where('trans_pincode_status', '=', 3)->get();
        $pinsellerditolak = Trans_pincode::whereIn('trans_pincode_user_id', $userseller)
                                            ->where('trans_pincode_status', '=', 4)->get();

        $pinmemberbaru = Trans_pincode::whereIn('trans_pincode_user_id', $usermember)
                                            ->where('trans_pincode_status', '=', 0)->get();
        $pinmemberkonf = Trans_pincode::whereIn('trans_pincode_user_id', $usermember)
                                            ->where('trans_pincode_status', '=', 1)->get();
        $pinmemberbatal = Trans_pincode::whereIn('trans_pincode_user_id', $usermember)
                                            ->where('trans_pincode_status', '=', 2)->get();
        $pinmemberapprove = Trans_pincode::whereIn('trans_pincode_user_id', $usermember)
                                            ->where('trans_pincode_status', '=', 3)->get();
        $pinmemberditolak = Trans_pincode::whereIn('trans_pincode_user_id', $usermember)
                                            ->where('trans_pincode_status', '=', 4)->get();

        return view('admin.dashboard.dashboard', 
            compact(
                'userseller', 'usermember', 
                'transseller', 'transmember', 
                'detailsellerorder', 'detailmemberorder', 
                'detailsellertransfer', 'detailmembertransfer',
                'detailsellerseller', 'detailmemberseller',
                'detailsellerpacking', 'detailmemberpacking',
                'detailsellershipping', 'detailmembershipping',
                'detailsellerdropping', 'detailmemberdropping',
                'hotsellerbaru', 'hotmemberbaru',
                'hotsellerkonf', 'hotmemberkonf',
                'hotsellerbatal', 'hotmemberbatal',
                'hotsellerapprove', 'hotmemberapprove',
                'hotsellerditolak', 'hotmemberditolak',
                'iklansellerbaru', 'iklanmemberbaru',
                'iklansellerkonf', 'iklanmemberkonf',
                'iklansellerbatal', 'iklanmemberbatal',
                'iklansellerapprove', 'iklanmemberapprove',
                'iklansellerditolak', 'iklanmemberditolak',
                'pinsellerbaru', 'pinmemberbaru',
                'pinsellerkonf', 'pinmemberkonf',
                'pinsellerbatal', 'pinmemberbatal',
                'pinsellerapprove', 'pinmemberapprove',
                'pinsellerditolak', 'pinmemberditolak'
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
    public function dashboardhotlist ()
    {
        $search = \Request::get('search');
        $userseller = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->where('user_store', '!=', null)->pluck('id')->toArray();
        $hotlistseller = Trans_hotlist::where('id', 'like', '%'.$search.'%')->whereIn('trans_hotlist_user_id', $userseller)->get();

        return view('admin.dashboard.seller.hotlist', compact('userseller', 'hotlistseller'));
    }
    public function dashboardiklan ()
    {
        $search = \Request::get('search');
        $userseller = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->where('user_store', '!=', null)->pluck('id')->toArray();
        $iklanseller = Trans_iklan::where('id', 'like', '%'.$search.'%')->whereIn('trans_iklan_user_id', $userseller)->get();

        return view('admin.dashboard.seller.iklan', compact('userseller', 'iklanseller'));
    }
    public function dashboardpincode ()
    {
        $search = \Request::get('search');
        $userseller = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->where('user_store', '!=', null)->pluck('id')->toArray();
        $pinseller = Trans_pincode::where('id', 'like', '%'.$search.'%')->whereIn('trans_pincode_user_id', $userseller)->get();

        return view('admin.dashboard.seller.pincode', compact('userseller', 'pinseller'));
    }
    public function dashboarddetailmember ()
    {
        $search = \Request::get('search');
        $usermember = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->pluck('id')->toArray();
        $transmember = Trans::where('trans_user_id', $usermember)->pluck('id')->toArray();
        $detailmember = Trans_detail::where('id', 'like', '%'.$search.'%')->whereIn('trans_detail_trans_id', $transmember)->get();

        return view('admin.dashboard.member.detailmember', compact('usermember', 'transmember', 'detailmember'));
    }
    public function dashboardhotlistmember ()
    {
        $search = \Request::get('search');
        $usermember = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->pluck('id')->toArray();
        $hotlistmember = Trans_hotlist::where('id', 'like', '%'.$search.'%')->whereIn('trans_hotlist_user_id', $usermember)->get();

        return view('admin.dashboard.member.hotlistmember', compact('usermember', 'hotlistmember'));
    }
    public function dashboardiklanmember ()
    {
        $search = \Request::get('search');
        $usermember = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->pluck('id')->toArray();
        $iklanmember = Trans_iklan::where('id', 'like', '%'.$search.'%')->whereIn('trans_iklan_user_id', $usermember)->get();

        return view('admin.dashboard.member.iklanmember', compact('usermember', 'iklanmember'));
    }
    public function dashboardpincodemember ()
    {
        $search = \Request::get('search');
        $usermember = User::whereHas('roles', function($query){
            $query->where('name','=','member');
            return $query;
        })
        ->pluck('id')->toArray();
        $pinmember = Trans_pincode::where('id', 'like', '%'.$search.'%')->whereIn('trans_pincode_user_id', $usermember)->get();

        return view('admin.dashboard.member.pincodemember', compact('usermember', 'pinmember'));
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
