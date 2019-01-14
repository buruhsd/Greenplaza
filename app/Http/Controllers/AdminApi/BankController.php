<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;

class BankController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'conf_bank';

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        if (!empty($keyword)) {
            $data['bank'] = Bank::where('bank_name', 'like',$keyword."%")->paginate($this->perPage);
        } else {
            $data['bank'] = Bank::paginate($this->perPage);
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function store(Request $request)
    {
        $status = 200;
        $message = 'Bank added!';
        
        $requestData = $request->all();
        
        $res = new Bank;
        $res->bank_kode = $request->bank_kode;
        $res->bank_name = $request->bank_name;
        $res->bank_note = $request->bank_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Bank Not added!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function show($id)
    {
        $data['bank'] = Bank::findOrFail($id);
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Bank updated!';
        
        $requestData = $request->all();
        
        $bank = Bank::findOrFail($id);
        $bank->bank_kode = $request->bank_kode;
        $bank->bank_name = $request->bank_name;
        $bank->bank_note = $request->bank_note;
        $bank->save();
        $res = $bank->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Bank Not updated!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function destroy($id)
    {
        $status = 200;
        $message = 'Bank deleted!';
        $res = Bank::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Bank Not deleted!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
}
