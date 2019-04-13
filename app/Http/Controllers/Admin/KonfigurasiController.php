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
use App\Models\Shipment;
use App\Models\User_shipment;
use Illuminate\Support\Str;
use Auth;
use Session;
use FunctionLib;
use App\Models\Conf_iklan;

class KonfigurasiController extends Controller
{

    public function buyer_address(Request $request)
    {
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.konfigurasi.aturaddress.index', $data);
    }
    
    //SETTING AKUN -> Ubah Alamat
    public function seller_address(Request $request)
    {
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.konfigurasi.aturaddress.index', $data);
    }

    /**
     * update password process
     * $request
     */
    public function seller_address_update(Request $request)
    {
        $status = 200;
        $message = 'Alamat penjual berhasil dirubah!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'user_detail_province' => 'required',
            'user_detail_city' => 'required',
            'user_detail_subdist' => 'required',
            'user_detail_pos' => 'required',
            'user_detail_address' => 'required',
        ]);

        $user = User::findOrFail(Auth::id());
        $userdetail = $user->user_detail()->first();
        $user->user_detail->user_detail_province = $request->user_detail_province;
        $user->user_detail->user_detail_city = $request->user_detail_city;
        $user->user_detail->user_detail_subdist = $request->user_detail_subdist;
        $user->user_detail->user_detail_pos = $request->user_detail_pos;
        $user->user_detail->user_detail_address = $request->user_detail_address;
        $userdetail = $user->user_detail;
        $userdetail->save();
        if(!$userdetail){
            $status = 500;
            $message = 'Alamat penjual gagal dirubah!';
        }
        return redirect('admin/konfigurasi/admin_address')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }


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
        $data['config'] = Conf_iklan::all();
        $data['iklan'] = Iklan::find($id);
        $data['user'] = User::whereHas('roles', function($query){
                $query->whereRaw('name IN ("member", "admin")');
                return $query;
            })->get();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.konfigurasi.settingiklan.iklanbannerkhusus.editiklan', $data);
    }
    public function edit_iklanadd (Request $request, $id)
    {
        $requestData = $request->all();
        dd($requestData);
        $this->validate($request, [
            'iklan_use' => 'required',
            'iklan_done' => 'required',
            'iklan_title' => 'required',
            'iklan_iklan_id' => 'required',
            'iklan_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $iklan = Iklan::find($id);
        $iklan->iklan_use = $request->iklan_use;
        $iklan->iklan_done = $request->iklan_done;
        $iklan->iklan_title = $request->iklan_title;
        $iklan->iklan_iklan_id = $request->iklan_iklan_id;
        
        if($request->iklan_user_id){
            if($user){
                $iklan->iklan_user_id = $iklan->user->id;
                if ($request->hasFile('iklan_image')){
                    $file = $request->file('iklan_image');
                    $path = public_path('assets/images/iklan');
                    $imagename = FunctionLib::doUpload($file, $path, $iklan->iklan_image);
                    $iklan->iklan_image = $imagename;
                }
                // if ($iklan->iklan_image != null && $request->iklan_image){
                //     $iklan->iklan_image = date("d-M-Y_H-i-s").'_'.$request->iklan_image->getClientOriginalName();
                //     $request->iklan_image->move(public_path('assets\images\iklan'),$iklan->iklan_image);
                // } elseif ($iklan->iklan_image == null && $request->iklan_image){
                //     $iklan->iklan_image = date("d-M-Y_H-i-s").'_'.$request->iklan_image->getClientOriginalName();
                //     $request->iklan_image->move(public_path('assets\images\iklan'),$iklan->iklan_image);
                // }
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
        $page->page_role_id = 0;
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
                        "level"=>"danger",
                        "message"=>"Page Status non Aktif."
            ]);
        return redirect()->back();
    }
    public function status_non_active (Request $request, $id)
    {
        $page = Page::find($id);
        $page->page_status = 0;
        $page->save();
        Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Page Status Aktif."
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
    // public function updatepass (Request $request)
    // {
    // 	$users = User::find(FunctionLib::get_config('konfigurasi_superadmin_id'));
    // 	return view('admin.konfigurasi.settingakun.updatepass.updatepass', compact('users'));
    // }
    // public function changepass (Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'old_password' => 'required',
    //         'password' => 'required',
    //         're_password' => 'required',
    //     ]);
    //     $users = User::find($id);
    //     if (!Hash::check($request->old_password, $users->password)) {
    //         Session::flash("flash_notification", [
    //             "level"=>"danger",
    //             "message"=>"Password salah."
    //         ]);
    //         return redirect()->back();
    //     }
    //     if ($request->password !== $request->re_password) {
    //         Session::flash("flash_notification", [
    //             "level"=>"danger",
    //             "message"=>"Password tidak sama."
    //         ]);
    //     } else {
    //         $users->password = bcrypt($request->password);
    //         $users->save();
    //         Session::flash("flash_notification", [
    //             "level"=>"success",
    //             "message"=>"Password Berhasil Diubah."
    //         ]);
    //     }
    //     return redirect()->back();
    // }

    public function change_password_admin(Request $request)
    {
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.konfigurasi.settingakun.updatepass.updatepass', $data);
    }

    /**
     * update password process
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function change_password_update_admin(Request $request)
    {
        $status = 200;
        $message = 'Password berhasil dirubah!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = User::findOrFail(Auth::id());
        if (!Hash::check($request->old_password, $user->password)) {
            $status = 500;
            $message = 'Password gagal dirubah!, masukkan password dengan benar!';
            return redirect('admin/konfigurasi/change_password_admin')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        if ($request->new_password !== $request->re_new_password) {
            $status = 500;
            $message = 'Password gagal dirubah!, masukkan konfirmasi password baru dengan benar';
            return redirect('admin/konfigurasi/change_password_admin')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        $password = $request->new_password;
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->save();
        if(!$user){
            $status = 500;
            $message = 'Password gagal dirubah!';
        }
        return redirect('admin/konfigurasi/change_password_admin')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    public function set_shipment(Request $request)
    {
        $data['shipment'] = Shipment::where('shipment_is_usable', 1)->get();
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.konfigurasi.aturkurir.set_shipment', $data);
    }

    /**
     * update password process
     * $request
     */
    public function set_shipment_update(Request $request)
    {
        $status = 200;
        $message = 'Jasa pengiriman berhasil dirubah!';
        $requestData = $request->all();
        $this->validate($request, [
            'user_shipment_shipment_id' => 'required',
        ]);

        $user = User::findOrFail(Auth::id());
        $id = Auth::id();
        $input = $requestData['user_shipment_shipment_id'];
        $usershipment = $user->user_shipment()->pluck('user_shipment_shipment_id')->toArray();
        // delete if uncheck
        array_walk($usershipment, function($value) use ($input, $id) {
            if(!in_array((integer)$value, $input)){
                User_shipment::where('user_shipment_shipment_id', $value)
                    ->where('user_shipment_user_id', $id)
                    ->delete();
            }
        });
        // insert if check and not exist
        array_walk($input, function($value) use ($usershipment, $id) {
            if(!in_array((integer)$value, $usershipment)){
                $user_shipment = new User_shipment;
                $user_shipment->user_shipment_user_id = $id;
                $user_shipment->user_shipment_shipment_id = $value;
                $user_shipment->save();
            }
        });
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    public function footer_script($method=''){
        ob_start();
        ?>
            <script type="text/javascript"></script>
        <?php
        switch ($method) {
            case 'edit_iklan':
                ?>
                    <link href="<?php echo asset('admin/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css') ?>" rel="stylesheet">
                    <script src="<?php echo asset('admin/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js') ?>"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-combobox/1.1.8/css/bootstrap-combobox.min.css">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-combobox/1.1.8/js/bootstrap-combobox.min.js"></script>
                    <script type="text/javascript">
                        $('.datepicker').datetimepicker();
                        $(document).ready(function(){
                            $('.combobox').combobox();
                            // bonus: add a placeholder
                            $('.combobox').attr('placeholder', 'Contoh, tulis "user"');
                        });
                    </script>
                <?php
                break;
            case 'sponsor':
            // case 'profil':
                ?>
                    <script type="text/javascript">
                        $(function(){
                            var rows, row;
                            get_province();
                        });
                        function get_province(){
                            $.ajax({
                                type: "GET", // or post?
                                url: "<?php echo url('localapi/content/get_province', 0);?>", // change as needed
                                beforeSend: function(){
                                    rows = "<option>Loading...</option>";
                                    $('#user_detail_province').empty();
                                    $('#user_detail_province').html(rows);
                                },
                                success: function(data) {
                                    var id = parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_province;?>");
                                    if (data) {
                                        $('#user_detail_province').empty();
                                        $.each( data.province, function(i, o){
                                            $check = (o.province_id == id)?"selected":"";
                                            row = "<option value="+o.province_id+" "+$check+">"+
                                                o.province+"</option>";
                                            $('#user_detail_province').append(row);
                                            if(i == 0){
                                                if(id !== null || id !== 0){
                                                    get_city(id);
                                                }else{
                                                    get_city(o.province_id);
                                                }
                                            }
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Layanan Tidak Tersedia",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    // $("#btn-choose-shipment").val(text);
                                },
                                error: function(xhr, textStatus) {
                                    swal({
                                        type: "error",
                                        title: "failed",   
                                        text: "Layanan Tidak Tersedia",   
                                        showConfirmButton: false ,
                                        showCloseButton: true,
                                        footer: ''
                                    });
                                    $("#btn-choose-shipment").val(text);
                                }
                            });
                        }
                        function get_city(id = 0){
                            $.ajax({
                                type: "GET", // or post?
                                url: "<?php echo url("localapi/content/get_city"); ?>/"+id, // change as needed
                                beforeSend: function(){
                                    rows = "<option>Loading...</option>";
                                    $('#user_detail_city').empty();
                                    $('#user_detail_city').html(rows);
                                },
                                success: function(data) {
                                    var id = parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_city;?>");
                                    if (data) {
                                        $('#user_detail_city').empty();
                                        $.each( data.city, function(i, o){
                                            $check = (o.city_id == id)?"selected":"";
                                            row = "<option value="+o.city_id+" "+$check+">"+o.city_name+"</option>";
                                            $('#user_detail_city').append(row);
                                            if(i == 0){
                                                if(id !== null || id !== 0){
                                                    get_subdistrict(id);
                                                }else{
                                                    get_subdistrict(o.city_id);
                                                }
                                            }
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Layanan Tidak Tersedia",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    // $("#btn-choose-shipment").val(text);
                                },
                                error: function(xhr, textStatus) {
                                    swal({
                                        type: "error",
                                        title: "failed",   
                                        text: "Layanan Tidak Tersedia",   
                                        showConfirmButton: false ,
                                        showCloseButton: true,
                                        footer: ''
                                    });
                                    $("#btn-choose-shipment").val(text);
                                }
                            });
                        }
                        function get_subdistrict(id){
                            $.ajax({
                                type: "GET", // or post?
                                url: "<?php echo url("localapi/content/get_subdistrict");?>/"+id, // change as needed
                                beforeSend: function(){
                                    rows = "<option>Loading...</option>";
                                    $('#user_detail_subdist').empty();
                                    $('#user_detail_subdist').html(rows);
                                },
                                success: function(data) {
                                    var id = parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_subdist;?>");
                                    if (data) {
                                        $('#user_detail_subdist').empty();
                                        $.each( data, function(i, o){
                                            $check = (o.subdistrict_id == id)?"selected":"";
                                            row = "<option value="+o.subdistrict_id+" "+$check+">"+o.subdistrict_name+"</option>";
                                            $('#user_detail_subdist').append(row);
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Layanan Tidak Tersedia",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    // $("#btn-choose-shipment").val(text);
                                },
                                error: function(xhr, textStatus) {
                                    swal({
                                        type: "error",
                                        title: "failed",   
                                        text: "Layanan Tidak Tersedia",   
                                        showConfirmButton: false ,
                                        showCloseButton: true,
                                        footer: ''
                                    });
                                    $("#btn-choose-shipment").val(text);
                                }
                            });
                        }
                    </script>
                <?php
                break;
            case 'buyer_address':
                ?>
                    
                <?php
                break;
            case 'profil':
            case 'seller_address':
                ?>
                    <script type="text/javascript">
                        $(function(){
                            var rows, row;
                            get_province();
                        });
                        function get_province(){
                            $.ajax({
                                type: "GET", // or post?
                                url: "<?php echo url('localapi/content/get_db_province', 0);?>", // change as needed
                                beforeSend: function(){
                                    rows = "<option>Loading...</option>";
                                    $('#user_detail_province').empty();
                                    $('#user_detail_province').html(rows);
                                },
                                success: function(data) {
                                    var id = parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_province;?>");
                                    if (data) {
                                        $('#user_detail_province').empty();
                                        $.each( data.province, function(i, o){
                                            $check = (o.id == id)?"selected":"";
                                            row = "<option value="+o.id+" "+$check+">"+
                                                o.province_name+"</option>";
                                            $('#user_detail_province').append(row);
                                            if(i == 0){
                                                get_city(o.id);
                                            }
                                            if($check == "selected"){
                                                get_city(id);
                                            }
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Layanan Tidak Tersedia",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    // $("#btn-choose-shipment").val(text);
                                },
                                error: function(xhr, textStatus) {
                                    swal({
                                        type: "error",
                                        title: "failed",   
                                        text: "Layanan Tidak Tersedia",   
                                        showConfirmButton: false ,
                                        showCloseButton: true,
                                        footer: ''
                                    });
                                    $("#btn-choose-shipment").val(text);
                                }
                            });
                        }
                        function get_city(id = 0){
                            $.ajax({
                                type: "GET", // or post?
                                url: "<?php echo url("localapi/content/get_db_city"); ?>/"+id, // change as needed
                                beforeSend: function(){
                                    rows = "<option>Loading...</option>";
                                    $('#user_detail_city').empty();
                                    $('#user_detail_city').html(rows);
                                },
                                success: function(data) {
                                    var id = parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_city;?>");
                                    if (data) {
                                        $('#user_detail_city').empty();
                                        $.each( data.city, function(i, o){
                                            $check = (o.id == id)?"selected":"";
                                            row = "<option value="+o.id+" "+$check+">"+o.city_name+"</option>";
                                            $('#user_detail_city').append(row);
                                            if(i == 0){
                                                get_subdistrict(o.id);
                                            }
                                            if($check == "selected"){
                                                get_subdistrict(id);
                                            }
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Layanan Tidak Tersedia",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    // $("#btn-choose-shipment").val(text);
                                },
                                error: function(xhr, textStatus) {
                                    swal({
                                        type: "error",
                                        title: "failed",   
                                        text: "Layanan Tidak Tersedia",   
                                        showConfirmButton: false ,
                                        showCloseButton: true,
                                        footer: ''
                                    });
                                    $("#btn-choose-shipment").val(text);
                                }
                            });
                        }
                        function get_subdistrict(id){
                            $.ajax({
                                type: "GET", // or post?
                                url: "<?php echo url("localapi/content/get_db_subdistrict");?>/"+id, // change as needed
                                beforeSend: function(){
                                    rows = "<option>Loading...</option>";
                                    $('#user_detail_subdist').empty();
                                    $('#user_detail_subdist').html(rows);
                                },
                                success: function(data) {
                                    var id = parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_subdist;?>");
                                    if (data) {
                                        $('#user_detail_subdist').empty();
                                        $.each( data, function(i, o){
                                            $check = (o.id == id)?"selected":"";
                                            row = "<option value="+o.id+" "+$check+">"+o.subdistrict_name+"</option>";
                                            $('#user_detail_subdist').append(row);
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Layanan Tidak Tersedia",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    // $("#btn-choose-shipment").val(text);
                                },
                                error: function(xhr, textStatus) {
                                    swal({
                                        type: "error",
                                        title: "failed",   
                                        text: "Layanan Tidak Tersedia",   
                                        showConfirmButton: false ,
                                        showCloseButton: true,
                                        footer: ''
                                    });
                                    $("#btn-choose-shipment").val(text);
                                }
                            });
                        }
                    </script>
                <?php
                break;
            case 'upload_foto_profil':
            case 'upload_scan_npwp':
            case 'upload_siup':
                ?>
                    <script type="text/javascript">
                        $(document).on('click', '#close-preview', function(){ 
                            $(this).parents(".parent-img").find('.image-preview').popover('hide');
                            // Hover befor close the preview
                            $('.image-preview').hover(
                                function () {
                                   $(this).popover('show');
                                }, 
                                 function () {
                                   $(this).popover('hide');
                                }
                            );    
                        });

                        $(function() {
                            // Create the close button
                            var closebtn = $('<button/>', {
                                type:"button",
                                text: 'x',
                                id: 'close-preview',
                                style: 'font-size: initial;',
                            });
                            closebtn.attr("class","close pull-right");
                            // Set the popover default content
                            $('.image-preview').popover({
                                trigger:'manual',
                                html:true,
                                title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                                content: "There's no image",
                                placement:'bottom'
                            });
                            // Clear event
                            $('.image-preview-clear').click(function(){
                                $(this).parents(".parent-img").find('.image-preview').attr("data-content","").popover('hide');
                                $(this).parents(".parent-img").find('.image-preview-filename').val("");
                                $(this).parents(".parent-img").find('.image-preview-clear').hide();
                                $(this).parents(".parent-img").find('.image-preview-input input:file').val("");
                                $(this).parents(".parent-img").find(".image-preview-input-title").text("Browse"); 
                            }); 
                            // Create the preview image
                            $(".image-preview-input input:file").change(function (){     
                                var img = $('<img/>', {
                                    id: 'dynamic',
                                    width:250,
                                    height:200
                                });      
                                var file = this.files[0];
                                var reader = new FileReader();
                                var x = $(this);
                                // Set preview image into the popover data-content
                                reader.onload = function (e) {
                                    $(x).parents(".parent-img").find(".image-preview-input-title").text("Change");
                                    $(x).parents(".parent-img").find(".image-preview-clear").show();
                                    $(x).parents(".parent-img").find(".image-preview-filename").val(file.name);
                                    img.attr('src', e.target.result);
                                    $(x).parents(".parent-img").find(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
                                }        
                                reader.readAsDataURL(file);
                            });  
                        });
                    </script>
                <?php
                break;
            case 'create':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'show':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'edit':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
        }
        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
