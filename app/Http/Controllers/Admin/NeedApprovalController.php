<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\User;
use App\Models\User_detail;
use App\Models\Produk;
use App\Models\Trans_iklan;
use App\Models\Trans_hotlist;
use App\Models\Trans_pincode;
use App\Models\User_address;
use Session;
use Mail;

class NeedApprovalController extends Controller
{
//WITHDRAWAL
    public function withdrawal_member ()
    {
    	$search = \Request::get('search');
        $with = Withdrawal::where('withdrawal_user_id', 'like', '%'.$search.'%')
                ->orderBy('created_at', 'DESC')->paginate(10);
    	return view('admin.need_approval.withdrawal.withdrawal_member', compact('with'));
    }

    public function withdrawal_seller ()
    {
        // $user = User::where('user_store', '!=', 'null')->get();
        // dd($user);
        $search = \Request::get('search');
        // $with = Withdrawal::where('withdrawal_user_id', 'like', '%'.$search.'%')
        //         ->orderBy('created_at', 'DESC')->with('userhasstore')->paginate(10);
                // dd($with);
            $with = Withdrawal::whereHas('user', function ($query) {
                    $query->where('user_store', '!=', 'null');
                })->paginate(10);
        return view('admin.need_approval.withdrawal.withdrawal_seller', compact('with'));
    }

    public function approve (Request $request, $id) 
    {
    	$with = Withdrawal::find($id);
    	$with->withdrawal_status = 1;
    	$with->save();
    	Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Withdraw Approved"
                    ]);
    	return redirect()->back(); 
    }
    public function reject (Request $request, $id) 
    {
    	$comment = $request->comment;
    	$with = Withdrawal::find($id);
    	$with->withdrawal_status = 2;
    	$with->save();
    	$users = User::where('id', $with->withdrawal_user_id)->first();
    	Mail::send('admin.mail.withdrawal_ditolak', compact('users', 'comment'), function ($m) use ($users, $comment) {
                $m->to($users->email, $users->name)->subject('Withdrawal Member Ditolak');
                Session::flash("flash_notification", [
                    "level" => "warning",
                    "message" => "Data Ditolak"
                ]);
            });
    	return redirect()->back(); 
    }

//SALDO IKLAN
    public function iklan ()
    {
        // $user = User::orderBy('id', 'DESC')->get();
        // dd($user);
        $iklan = Trans_iklan::orderBy('created_at', 'DESC')->get();
        return view('admin.need_approval.saldoiklan.saldoiklan', compact('iklan'));
    }

    public function konfirmasi_iklan (Request $request, $id) 
    {
        $iklan = Trans_iklan::find($id);
        $iklan->trans_iklan_status = 2;
        $iklan->save();
        return redirect()->back(); 
    }

    public function approve_admin (Request $request, $id) 
    {
        $iklan = Trans_iklan::find($id);
        $iklan->trans_iklan_status = 3;
        $iklan->save();
        return redirect()->back(); 
    }

    public function tolak (Request $request, $id) 
    {
        $iklan = Trans_iklan::find($id);
        $iklan->trans_iklan_status = 4;
        $iklan->save();
        return redirect()->back(); 
    }

//IKLAN
    //BANNER_KHUSUS
    public function banner_khusus () 
    {
        return view('admin.need_approval.iklan.bannerkhusus.banner_khusus');
    }
    public function bannerkhusus_review () 
    {
        return view('admin.need_approval.iklan.bannerkhusus.menunggu_review');
    }
    public function bannerkhusus_aktif () 
    {
        return view('admin.need_approval.iklan.bannerkhusus.aktif');
    }
    public function bannerkhusus_ditolak () 
    {
        return view('admin.need_approval.iklan.bannerkhusus.ditolak');
    }
    //BANNER_SLIDER
    public function banner_slider () 
    {
        return view('admin.need_approval.iklan.bannerslider.banner_slider');
    }
    public function bannerslider_review () 
    {
        return view('admin.need_approval.iklan.bannerslider.menunggu_review');
    }
    public function bannerslider_aktif () 
    {
        return view('admin.need_approval.iklan.bannerslider.aktif');
    }
    public function bannerslider_ditolak () 
    {
        return view('admin.need_approval.iklan.bannerslider.ditolak');
    }
    //BANNER_SELLER
    public function banner_seller () 
    {
        return view('admin.need_approval.iklan.bannerseller.banner_seller');
    }
    public function bannerseller_review () 
    {
        return view('admin.need_approval.iklan.bannerseller.menunggu_review');
    }
    public function bannerseller_aktif () 
    {
        return view('admin.need_approval.iklan.bannerseller.aktif');
    }
    public function bannerseller_ditolak () 
    {
        return view('admin.need_approval.iklan.bannerseller.ditolak');
    }
    //BANNER_PEMBELI
    public function banner_pembeli () 
    {
        return view('admin.need_approval.iklan.bannerpembeli.banner_pembeli');
    }
    public function bannerpembeli_review () 
    {
        return view('admin.need_approval.iklan.bannerpembeli.menunggu_review');
    }
    public function bannerpembeli_aktif () 
    {
        return view('admin.need_approval.iklan.bannerpembeli.aktif');
    }
    public function bannerpembeli_ditolak () 
    {
        return view('admin.need_approval.iklan.bannerpembeli.ditolak');
    }
    //BARIS_SELLER
    public function baris_seller () 
    {
        return view('admin.need_approval.iklan.baris_seller');
    }


    public function baris_pembeli () 
    {
        return view('admin.need_approval.iklan.baris_pembeli');
    }

//LIST SELLER/MEMBER
    //MEMBER
    public function listmember ()
    {
        $search = \Request::get('search');
        $users = User::where('name', 'like', '%'.$search.'%')
                ->orderBy('updated_at', 'DESC')->paginate(10);
        $address = User_address::where('user_address_status', '=', 1)->orderBy('updated_at', 'DESC')->paginate(10);
        // dd($address);
       
        return view('admin.need_approval.akun_member.listmember', compact('users', 'address'));
    }
    public function changepassword_member (Request $request, $id)
    {
        $users = User::find($id);
        // dd($users);
        return view('admin.need_approval.akun_member.resetpassword_member', compact('users', 'address'));
    }
    public function password_member (Request $request, $id)
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
    public function detailmember (Request $request, $id)
    {
        $users = User::find($id);
        $detail = User_detail::where('user_detail_user_id', $users->id)->first();
        return view('admin.need_approval.akun_member.detailmember', compact('users', 'detail'));
    }

    public function editmember (Request $request, $id)
    {
        $users = User::find($id);
        return view('admin.need_approval.akun_member.editmember', compact('users'));
    }

    function editmember_data (Request $request, $id)
    {
        $value = $request->value;
        $users = User::find($id);
        $users->username = $request->username;
        $users->name = $request->name;
        $users->user_store = $request->user_store;
        if ($users->user_store_image != null && $request->user_store_image) {
        $users->user_store_image = date("d-M-Y_H-i-s").'_'.$request->user_store_image->getClientOriginalName();
        $request->user_store_image->move(public_path('assets/images/user_store'),$users->user_store_image);
        $users->save();
        } elseif ($users->user_store_image == null && $request->user_store_image) {
        $users->user_store_image = date("d-M-Y_H-i-s").'_'.$request->user_store_image->getClientOriginalName();
        $request->user_store_image->move(public_path('assets/images/user_store'),$users->user_store_image);
        $users->save();
        }
        $users->user_slogan = $request->user_slogan;
        if ($value == $request->password){
            $users->password = bcrypt($request->password);
            $users->save();
            Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Profile Berhasil Diubah."
            ]);
        } else {
            Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"Password Salah"
            ]);
        }
        return redirect()->back();
    }

    //SELLER
     public function listseller ()
    {
        $search = \Request::get('search');
        $users = User::where('name', 'like', '%'.$search.'%')
                ->orderBy('updated_at', 'DESC')
                ->where('user_store', '!=', null)
                ->paginate(10);
        return view('admin.need_approval.akun_member.listseller', compact('users'));
    }
    public function changepassword_seller (Request $request, $id)
    {
        $users = User::find($id);
        return view('admin.need_approval.akun_member.resetpassword_seller', compact('users'));
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
    public function detailseller (Request $request, $id)
    {
        $users = User::find($id);
        // dd($users);
        $detail = User_detail::where('user_detail_user_id', $users->id)->first();
        // dd($detail);
        return view('admin.need_approval.akun_member.detailseller', compact('users', 'detail'));
    }

//TRANSAKSI HOTLIST
    public function hotlist ()
    {
        $search = \Request::get('search');
        $hot = Trans_hotlist::where('trans_hotlist_code', 'like', '%'.$search.'%')->orderBy('created_at', 'DESC')->get();
        // dd($hot);
        return view('admin.need_approval.transaksi_hotlist.hotlist', compact('hot'));
    }
    public function konfirmasi_hotlist (Request $request, $id) 
    {
        $hot = Trans_hotlist::find($id);
        $hot->trans_hotlist_status = 2;
        $hot->save();
        return redirect()->back(); 
    }

    public function approve_adminhotlist (Request $request, $id) 
    {
        $hot = Trans_hotlist::find($id);
        $hot->trans_hotlist_status = 3;
        $hot->save();
        return redirect()->back(); 
    }

    public function tolakhotlist (Request $request, $id) 
    {
        $hot = Trans_hotlist::find($id);
        $hot->trans_hotlist_status = 4;
        $hot->save();
        return redirect()->back(); 
    }

//TRANSAKI BARANG
    public function barang ()
    {
        return view('admin.need_approval.transaksi_barang.barang_list');

    }

//TRANSAKSI PINCODE 
    public function pincode () 
    {
        $search = \Request::get('search');
        $pin = Trans_pincode::where('trans_pincode_code', 'like', '%'.$search.'%')->orderBy('created_at', 'DESC')->get();
        return view('admin.need_approval.transaksi_pincode.pincode', compact('pin'));
    }
    public function konfirmasi_pincode (Request $request, $id) 
    {
        $pin = Trans_pincode::find($id);
        $pin->trans_pincode_status = 2;
        $pin->save();
        return redirect()->back(); 
    }

    public function approve_adminpincode (Request $request, $id) 
    {
        $pin = Trans_pincode::find($id);
        $pin->trans_pincode_status = 3;
        $pin->save();
        return redirect()->back(); 
    }

    public function tolakpincode (Request $request, $id) 
    {
        $pin = Trans_pincode::find($id);
        $pin->trans_pincode_status = 4;
        $pin->save();
        return redirect()->back(); 
    }

    //PRODUK ADMIN
    public function produkadmin ()
    {
        $users = User::whereHas('roles', function($query){
                $query->where('name','=','admin');
                return $query;
            })
           ->pluck('id')->toArray();
        $produk = Produk::whereIn('produk_seller_id', $users)->orderBy('created_at', 'DESC')->get();
        return view('admin.need_approval.produk_admin.produkadmin', compact('users', 'produk'));
    }
    public function create_produk ()
    {
        $data['role'] = Role::all();
        $data['user'] = User::all();
        $data['category'] = Category::all();
        $data['produk_unit'] = Produk_unit::all();
        $data['produk_location'] = Produk_location::all();
        $data['brand'] = Brand::all();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.need_approval.produk_admin.create', $data);
    }
}
