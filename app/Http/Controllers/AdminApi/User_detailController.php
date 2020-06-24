<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_detail;
use App\User;

class User_detailController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_user_detail';

    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['user_detail'] = User_detail::paginate($this->perPage);
        } else {
            $data['user_detail'] = User_detail::paginate($this->perPage);
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function store(Request $request)
    {
        $status = 200;
        $message = 'User_detail added!';
        
        $requestData = $request->all();
        
        $res = new User_detail;
        $res->user_detail_jk = $request->user_detail_jk;
        $res->user_detail_token = $request->user_detail_token;
        $res->user_detail_address = $request->user_detail_address;
        $res->user_detail_phone = $request->user_detail_phone;
        $res->user_detail_tlp = $request->user_detail_tlp;
        $res->user_detail_province = $request->user_detail_province;
        $res->user_detail_city = $request->user_detail_city;
        $res->user_detail_subdist = $request->user_detail_subdist;
        $res->user_detail_pos = $request->user_detail_pos;
        $res->user_detail_image = $request->user_detail_image;
        $res->user_detail_bank_name = $request->user_detail_bank_name;
        $res->user_detail_bank_owner = $request->user_detail_bank_owner;
        $res->user_detail_bank_no = $request->user_detail_bank_no;
        $res->user_detail_note = $request->user_detail_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'User_detail Not added!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function show($id)
    {
        $data['user_detail'] = User_detail::findOrFail($id);
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Detail user berhasil ditambahkan';
        
        $requestData = $request->all();
        
        $user_detail = User_detail::findOrFail($id);
        $user_detail->user_detail_jk = $request->user_detail_jk;
        $user_detail->user_detail_token = $request->user_detail_token;
        $user_detail->user_detail_address = $request->user_detail_address;
        $user_detail->user_detail_phone = $request->user_detail_phone;
        $user_detail->user_detail_tlp = $request->user_detail_tlp;
        $user_detail->user_detail_province = $request->user_detail_province;
        $user_detail->user_detail_city = $request->user_detail_city;
        $user_detail->user_detail_subdist = $request->user_detail_subdist;
        $user_detail->user_detail_pos = $request->user_detail_pos;
        $user_detail->user_detail_image = $request->user_detail_image;
        $user_detail->user_detail_bank_name = $request->user_detail_bank_name;
        $user_detail->user_detail_bank_owner = $request->user_detail_bank_owner;
        $user_detail->user_detail_bank_no = $request->user_detail_bank_no;
        $user_detail->user_detail_note = $request->user_detail_note;
        $user_detail->save();
        $res = $user_detail->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'User_detail Not updated!';
        }

        return response()->json(['success' => $status, 'message'=>$message]);

        // return redirect('admin/user_detail')
        //     ->with(['flash_status' => $status,'flash_message' => $message]);
    }
    public function destroy($id)
    {
        $status = 200;
        $message = 'User_detail deleted!';
        $res = User_detail::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'User_detail Not deleted!';
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }

    public function show_user($id)
    {
        $data['user'] = User::where('id', $id)->with(['user_detail'])->first();
        return response()->json(['success' => true, 'data'=>$data]);
    }

    public function show_user_update(Request $request, $id)
    {
        $status = 200;
        $message = 'Detail user berhasil ditambahkan';
        
        $requestData = $request->all();
        $user =User::findOrFail($id);

        $image = $request->user_store_image;
        $imageInfo = explode(";base64,", $image);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);      
        $image = str_replace(' ', '+', $imageInfo[1]);
        $imageName = time().".".$imgExt;
        \File::put(public_path(). '/assets/images/profil/' . $imageName, base64_decode($image));

        $user->username = $request->username;
        $user->name = $request->name;
        $user->user_store = $request->user_store;
        $user->user_slogan = $request->user_slogan;
        $user->user_store_image = $imageName;
        $user->save();

        $user->user_detail->user_detail_jk = $request->user_detail_jk;
        $user->user_detail->user_detail_token = $request->user_detail_token;
        $user->user_detail->user_detail_address = $request->user_detail_address;
        $user->user_detail->user_detail_phone = $request->user_detail_phone;
        $user->user_detail->user_detail_tlp = $request->user_detail_tlp;
        $user->user_detail->user_detail_province = $request->user_detail_province;
        $user->user_detail->user_detail_city = $request->user_detail_city;
        $user->user_detail->user_detail_subdist = $request->user_detail_subdist;
        $user->user_detail->user_detail_pos = $request->user_detail_pos;
        $user->user_detail->user_detail_image = $request->user_detail_image;
        $user->user_detail->user_detail_bank_name = $request->user_detail_bank_name;
        $user->user_detail->user_detail_bank_owner = $request->user_detail_bank_owner;
        $user->user_detail->user_detail_bank_no = $request->user_detail_bank_no;
        $user->user_detail->user_detail_note = $request->user_detail_note;
        $user->user_detail->save();

        return response()->json(['success' => true, 'data'=>$user]);
    }
}
