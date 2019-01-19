<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Grade;
use App\Models\Page;
use App\Models\User_detail;
use App\Models\Sponsor;
use App\Models\Official_email;
use App\Models\Iklan;
use App\Role;
use App\User;
use Session;
use FunctionLib;

class KonfigurasiController extends Controller
{
    //SETTING HARGA
	//REG SELLER
    public function regseller ()
    {
    	return view('admin.konfigurasi.settingharga.regseller.regseller');
    }
    public function tambah_regseller ()
    {
    	return view('admin.konfigurasi.settingharga.regseller.tambah');
    }

	//HARGA IKLAN
    public function hargaiklan ()
    {
    	return view('admin.konfigurasi.settingharga.hargaiklan.hargaiklan');
    }

	//HARGA BELI SALDO
    public function hargabeli ()
    {
    	return view('admin.konfigurasi.settingharga.hargabelisaldo.hargabeli');
    }
    public function tambah_hargabeli ()
    {
    	return view('admin.konfigurasi.settingharga.hargabelisaldo.tambah');
    }
    public function update_hargabeli ()
    {
    	return view('admin.konfigurasi.settingharga.hargabelisaldo.update');
    }

    //SETTING IKLAN
    //IKLAN SLIDER
    public function iklanslider ()
    {
    	return view('admin.konfigurasi.settingiklan.iklanslider.iklanslider');
    }
    public function tambah_iklanslider ()
    {
    	return view('admin.konfigurasi.settingiklan.iklanslider.tambah');
    }

    //IKLAN BANNER KHUSUS
    public function iklanbanner ()
    {
        $iklan = Iklan::orderBy('created_at', 'DESC')->paginate(10);
    	return view('admin.konfigurasi.settingiklan.iklanbannerkhusus.iklanbanner', compact('iklan'));
    }
    public function tambah_iklanbanner ()
    {
    	return view('admin.konfigurasi.settingiklan.iklanbannerkhusus.tambah');
    }
    public function add_iklanbanner (Request $request)
    {
        $this->validate($request, [
            'iklan_title' => 'required',
            'iklan_iklan_id' => 'required',
            'iklan_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]); 

        $iklan = new Iklan;
        $iklan->iklan_title = $request->iklan_title;
        $iklan->iklan_iklan_id = $request->iklan_iklan_id;
        $iklan->iklan_image = date("d-M-Y_H-i-s").'_'.$request->iklan_image->getClientOriginalName();
        $request->iklan_image->move(public_path('assets\images\iklan'),$iklan->iklan_image);
        if($request->iklan_user_id){
            $user = User::where('name', $request->iklan_user_id)->first();
            if($user){
                $iklan->iklan_user_id = $user->id;
                $iklan->save();
                
            } else {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Nama yang di inputkan tidak terdaftar atau salah."
                        ]);
                return redirect()->back();
            } 
        }
        Session::flash("flash_notification", [
                            "level"=>"success",
                            "message"=>"Berhasil Menambahkan Iklan."
                        ]);
        return redirect()->back();
    }
    public function delete_iklan (Request $request, $id)
    {
        $iklan = Iklan::find($id);
        $iklan->delete();
        return redirect()->back();
    }
    public function edit_iklan (Request $request, $id)
    {
        $iklan = Iklan::find($id);
        return view('admin.konfigurasi.settingiklan.iklanbannerkhusus.editiklan', compact('iklan'));
    }
    public function edit_iklanadd (Request $request, $id)
    {
        $iklan = Iklan::find($id);
        $iklan->iklan_title = $request->iklan_title;
        $iklan->iklan_iklan_id = $request->iklan_iklan_id;
        
        if($request->iklan_user_id){
            $user = User::where('name', $request->iklan_user_id)->first();
            if($user){
                $iklan->iklan_user_id = $user->id;
                if ($iklan->iklan_image != null && $request->iklan_image){
                    $iklan->iklan_image = date("d-M-Y_H-i-s").'_'.$request->iklan_image->getClientOriginalName();
                    $request->iklan_image->move(public_path('assets\images\iklan'),$iklan->iklan_image);
                } elseif ($iklan->iklan_image == null && $request->iklan_image){
                    $iklan->iklan_image = date("d-M-Y_H-i-s").'_'.$request->iklan_image->getClientOriginalName();
                    $request->iklan_image->move(public_path('assets\images\iklan'),$iklan->iklan_image);
                }
                $iklan->save();
                
            } else {
                Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Nama yang di inputkan tidak terdaftar atau salah."
                        ]);
                return redirect()->back();
            } 
        }
        Session::flash("flash_notification", [
                            "level"=>"success",
                            "message"=>"Berhasil Mengedit Iklan."
                        ]);
        return redirect()->back();
    }
    public function publish (Request $request, $id)
    {
        $iklan = Iklan::find($id);
        $iklan->iklan_status = 1;
        $iklan->save();
        Session::flash("flash_notification", [
                            "level"=>"success",
                            "message"=>"Iklan Publish."
                        ]);
        return redirect()->back();
    }
    public function unpublish (Request $request, $id)
    {
        $iklan = Iklan::find($id);
        $iklan->iklan_status = 0;
        $iklan->save();
        Session::flash("flash_notification", [
                            "level"=>"danger",
                            "message"=>"Iklan Un-publish."
                        ]);
        return redirect()->back();
    }

//PROFILE GREENPLAZA
    //OFFICIAL EMAIL
    public function officialemail ()
    {
        $email = Official_email::orderBy('created_at', 'DESC')->get();
        // dd($email);
    	return view('admin.konfigurasi.profilegreenplaza.officialemail.officialemail', compact('email'));
    }
    public function delete_email (Request $request, $id)
    {
        $email = Official_email::find($id);
        $email->delete();
        Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"Email Berhasil di Hapus."
            ]);
        return redirect()->back();
    }

    //SETTING AKUN
    //AKUN ADMIN
    public function akunadmin ()
    {
        $users = User::whereHas('roles', function($query){
                $query->where('name','=','admin');
                return $query;
            })
            ->get();
        // dd($users);
    	return view('admin.konfigurasi.settingakun.akunadmin.akunadmin', compact('users'));
    }
    public function tambah_akunadmin ()
    {
    	return view('admin.konfigurasi.settingakun.akunadmin.tambah');
    }
    public function add (Request $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'token_register'=>str_random(190)
        ]);

        // update detail user
        if($user){
            $user_detail = User_detail::create([
                'user_detail_user_id' => $user->id,
                'user_detail_pass_trx' => Hash::make($data['password']),
                'user_detail_jk' => $data['user_detail_jk'],
                // 'user_detail_address' => $data['user_detail_address'],
                'user_detail_phone' => $data['user_detail_phone'],
                'user_detail_province' => $data['user_detail_province'],
                'user_detail_city' => $data['user_detail_city'],
                'user_detail_subdist' => $data['user_detail_subdist'],
                'user_detail_pos' => $data['user_detail_pos'],
                'user_detail_token' => "",//$data['user_detail_status'],
                'user_detail_status' => 0//$data['user_detail_status'],
            ]);
            $user_sponsor = Sponsor::create([
                'user_tree_user_id' => $user->id,
                'user_tree_sponsor_id' => 1,
            ]);
            $user_detail = User_address::create([
                'user_address_user_id' => $user->id,
                'user_address_label' => 'Saya',
                'user_address_owner' => 'Saya',
                'user_address_address' => " ",
                'user_address_phone' => $data['user_detail_phone'],
                'user_address_province' => $data['user_detail_province'],
                'user_address_city' => $data['user_detail_city'],
                'user_address_subdist' => $data['user_detail_subdist'],
                'user_address_pos' => $data['user_detail_pos'],
            ]);
        }

        // get role member
        $adminRole = Role::where('name', 'admin')->pluck('name');
        $insert_role = $user->assignRole($adminRole);
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Akun Berhasil di Tambahkan."
        ]);
    	return redirect()->back();
    }
    public function deleteadmin (Request $request, $id)
    {
        $users = User::find($id);
        $users->delete();
        Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"Akun Berhasil di Hapus."
            ]);
        return redirect()->back();
    }

    //PAGELIST
    public function pagelist ()
    {
        $page = Page::orderBy('created_at', 'DESC')->paginate(10);
    	return view('admin.konfigurasi.settingakun.pagelist.pagelist', compact('page'));
    }
    public function tambah_pagelist ()
    {
    	return view('admin.konfigurasi.settingakun.pagelist.tambah');
    }
    public function add_page (Request $request)
    {
        $page = new Page;
        $page->page_judul = $request->page_judul;
        $page->page_role_id = $request->page_role_id;
        $page->page_kategori = $request->page_kategori;
        $page->page_text = $request->page_text;
        $page->page_slug = str_slug($request->page_judul);
        $page->save();
        Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Page Berhasil di Tambahkan."
            ]);
        return redirect()->back();
    }
    public function status_active (Request $request, $id)
    {
        $page = Page::find($id);
        $page->page_status = 1;
        $page->save();
        Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Page Status Aktif."
            ]);
        return redirect()->back();
    }
    public function status_non_active (Request $request, $id)
    {
        $page = Page::find($id);
        $page->page_status = 0;
        $page->save();
        Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"Page Status Non Aktif."
            ]);
        return redirect()->back();
    }
    public function edit_page (Request $request, $id)
    {
        $page = Page::find($id);
        return view('admin.konfigurasi.settingakun.pagelist.editpage', compact('page'));
    }
    public function edit_page_add (Request $request, $id)
    {
        $page = Page::find($id);
        $page->page_judul = $request->page_judul;
        
        $page->page_text = $request->page_text;
        $page->page_slug = str_slug($request->page_judul);
        if($request->page_role_id){
            if ($page->page_role_id != null && $request->page_role_id || $page->page_kategori != null && $request->page_kategori){
                $page->page_role_id =$request->page_role_id;
                $page->page_kategori =$request->page_kategori;
            } elseif ($page->iklapage_role_id == null && $request->page_role_id || $page->page_kategori == null && $request->page_kategori){
                $page->page_role_id =$request->page_role_id;
                $page->page_kategori =$request->page_kategori;
            }
            $page->save();
                
        } 
        $page->save();

        Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Page Berhasil di Edit."
            ]);
        return redirect()->back();
    }
    public function perview (Request $request, $id)
    {
        $page = Page::find($id);
        return view('admin.konfigurasi.settingakun.pagelist.perview', compact('page'));
    }
    public function deletepage (Request $request, $id)
    {
        $page = Page::find($id);
        $page->delete();
        Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"Page Berhasil di Hapus."
            ]);
        return redirect()->back();
    }

    //GRADE
    public function grademember ()
    {
    	$grade = Grade::where('grade_member_status', '=', 2)->orderBy('grade_member_range', 'ASC')->get();
    	// dd($grade);
    	return view('admin.konfigurasi.settingakun.grade.grademember', compact('grade'));
    }
    public function add_grademember (Request $request)
    {
    	$grade = new Grade;
    	$grade->grade_member_name = $request->grade_member_name;
    	$grade->grade_member_range = $request->grade_member_range;
    	$grade->grade_member_status = 2;
    	$grade->save();
    	Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Grade Berhasil di Tambahkan."
            ]);
    	return redirect()->back();
    }
    public function update_grademember (Request $request, $id)
    {
    	$grade = Grade::find($id);
    	$grade->grade_member_name = $request->grade_member_name;
    	$grade->grade_member_range = $request->grade_member_range;
    	$grade->save();
    	Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Grade Berhasil Terupdate."
            ]);
    	return redirect()->back();
    }
    public function delete_grademember (Request $request, $id)
    {
    	$grade = Grade::find($id);
    	$grade->delete();
    	Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"Grade Berhasil Dihapus."
            ]);
    	return redirect()->back();

    }
    public function gradeseller ()
    {
    	$grade = Grade::where('grade_member_status', '=', 1)->orderBy('created_at', 'DESC')->get();
    	return view('admin.konfigurasi.settingakun.grade.gradeseller', compact('grade'));
    }
    public function add_gradeseller (Request $request)
    {
    	$grade = new Grade;
    	$grade->grade_member_name = $request->grade_member_name;
    	$grade->grade_member_range = $request->grade_member_range;
    	$grade->grade_member_status = 1;
    	$grade->save();
    	Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Grade Berhasil di Tambahkan."
            ]);
    	return redirect()->back();
    }
    public function update_gradeseller (Request $request, $id)
    {
    	$grade = Grade::find($id);
    	$grade->grade_member_name = $request->grade_member_name;
    	$grade->grade_member_range = $request->grade_member_range;
    	$grade->save();
    	Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Grade Berhasil Terupdate."
            ]);
    	return redirect()->back();
    }
    public function delete_gradeseller (Request $request, $id)
    {
    	$grade = Grade::find($id);
    	$grade->delete();
    	Session::flash("flash_notification", [
                        "level"=>"danger",
                        "message"=>"Grade Berhasil Dihapus."
            ]);
    	return redirect()->back();

    }

    //UPDATEPASS
    public function updatepass (Request $request)
    {
    	$users = User::find(FunctionLib::get_config('konfigurasi_superadmin_id'));
    	return view('admin.konfigurasi.settingakun.updatepass.updatepass', compact('users'));
    }
    public function changepass (Request $request, $id)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required',
            're_password' => 'required',
        ]);
        $users = User::find($id);
        if (!Hash::check($request->old_password, $users->password)) {
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Password salah."
            ]);
            return redirect()->back();
        }
        if ($request->password !== $request->re_password) {
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Password tidak sama."
            ]);
        } else {
            $users->password = bcrypt($request->password);
            $users->save();
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Password Berhasil Diubah."
            ]);
        }
        return redirect()->back();
    }
}
