<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk_unit;

class Produk_unitController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_produk_unit';

    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['produk_unit'] = Produk_unit::paginate($this->perPage);
        } else {
            $data['produk_unit'] = Produk_unit::paginate($this->perPage);
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function store(Request $request)
    {
        $status = 200;
        $message = 'Produk_unit added!';
        
        $requestData = $request->all();
        
        $res = new Produk_unit;
        $res->produk_unit_name = $request->produk_unit_name;
        $res->produk_unit_note = $request->produk_unit_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Produk_unit Not added!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function show($id)
    {
        $data['produk_unit'] = Produk_unit::findOrFail($id);
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Produk_unit added!';
        
        $requestData = $request->all();
        
        $produk_unit = Produk_unit::findOrFail($id);
        $produk_unit->produk_unit_name = $request->produk_unit_name;
        $produk_unit->produk_unit_note = $request->produk_unit_note;
        $produk_unit->save();
        $res = $produk_unit->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Produk_unit Not updated!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function destroy($id)
    {
        $status = 200;
        $message = 'Produk_unit deleted!';
        $res = Produk_unit::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Produk_unit Not deleted!';
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
}
