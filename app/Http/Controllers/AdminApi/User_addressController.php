<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_address;

class User_addressController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_user_address';

    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['user_address'] = User_address::paginate($this->perPage);
        } else {
            $data['user_address'] = User_address::paginate($this->perPage);
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function store(Request $request)
    {
        $status = 200;
        $message = 'User_address added!';
        
        $requestData = $request->all();
        
        $res = new User_address;
        $res->user_address_user_id = $request->user_address_user_id;
        $res->user_address_label = $request->user_address_label;
        $res->user_address_owner = $request->user_address_owner;
        $res->user_address_address = $request->user_address_address;
        $res->user_address_phone = $request->user_address_phone;
        $res->user_address_tlp = $request->user_address_tlp;
        $res->user_address_province = $request->user_address_province;
        $res->user_address_city = $request->user_address_city;
        $res->user_address_subdist = $request->user_address_subdist;
        $res->user_address_pos = $request->user_address_pos;
        $res->user_address_note = $request->user_address_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'User_address Not added!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function show($id)
    {
        $data['user_address'] = User_address::findOrFail($id);
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'User_address added!';
        
        $requestData = $request->all();
        
        $user_address = User_address::findOrFail($id);
        $user_address->user_address_user_id = $request->user_address_user_id;
        $user_address->user_address_label = $request->user_address_label;
        $user_address->user_address_owner = $request->user_address_owner;
        $user_address->user_address_address = $request->user_address_address;
        $user_address->user_address_phone = $request->user_address_phone;
        $user_address->user_address_tlp = $request->user_address_tlp;
        $user_address->user_address_province = $request->user_address_province;
        $user_address->user_address_city = $request->user_address_city;
        $user_address->user_address_subdist = $request->user_address_subdist;
        $user_address->user_address_pos = $request->user_address_pos;
        $user_address->user_address_note = $request->user_address_note;
        $user_address->save();
        $res = $user_address->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'User_address Not updated!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function destroy($id)
    {
        $status = 200;
        $message = 'User_address deleted!';
        $res = User_address::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'User_address Not deleted!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
}
