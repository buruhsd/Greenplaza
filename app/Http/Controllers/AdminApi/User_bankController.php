<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_bank;

class User_bankController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_user_bank';

    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['user_bank'] = User_bank::paginate($this->perPage);
        } else {
            $data['user_bank'] = User_bank::paginate($this->perPage);
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function store(Request $request)
    {
        $status = 200;
        $message = 'User_bank added!';
        
        $requestData = $request->all();
        
        $res = new User_bank;
        $res->user_bank_user_id = $response->user_bank_user_id;
        $res->user_bank_name = $response->user_bank_name;
        $res->user_bank_owner = $response->user_bank_owner;
        $res->user_bank_no = $response->user_bank_no;
        $res->user_bank_note = $response->user_bank_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'User_bank Not added!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function show($id)
    {
        $data['user_bank'] = User_bank::findOrFail($id);
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'User_bank added!';
        
        $requestData = $request->all();
        
        $user_bank = User_bank::findOrFail($id);
        $user_bank->user_bank_user_id = $response->user_bank_user_id;
        $user_bank->user_bank_name = $response->user_bank_name;
        $user_bank->user_bank_owner = $response->user_bank_owner;
        $user_bank->user_bank_no = $response->user_bank_no;
        $user_bank->user_bank_note = $response->user_bank_note;
        $user_bank->save();
        $res = $user_bank->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'User_bank Not updated!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function destroy($id)
    {
        $status = 200;
        $message = 'User_bank deleted!';
        $res = User_bank::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'User_bank Not deleted!';
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
}
