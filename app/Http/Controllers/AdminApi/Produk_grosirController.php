<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk_grosir;

class Produk_grosirController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_produk_grosir';

    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['produk_grosir'] = Produk_grosir::paginate($this->perPage);
        } else {
            $data['produk_grosir'] = Produk_grosir::paginate($this->perPage);
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function store(Request $request)
    {
        $status = 200;
        $message = 'Produk_grosir added!';
        
        $requestData = $request->all();
        
        $res = new Produk_grosir;
        $res->produk_grosir_produk_id = $request->produk_grosir_produk_id;
        $res->produk_grosir_start = $request->produk_grosir_start;
        $res->produk_grosir_end = $request->produk_grosir_end;
        $res->produk_grosir_price = $request->produk_grosir_price;
        $res->produk_grosir_note = $request->produk_grosir_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Produk_grosir Not added!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function show($id)
    {
        $data['produk_grosir'] = Produk_grosir::findOrFail($id);
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Produk_grosir added!';
        
        $requestData = $request->all();
        
        $produk_grosir = Produk_grosir::findOrFail($id);
        $produk_grosir->produk_grosir_produk_id = $request->produk_grosir_produk_id;
        $produk_grosir->produk_grosir_start = $request->produk_grosir_start;
        $produk_grosir->produk_grosir_end = $request->produk_grosir_end;
        $produk_grosir->produk_grosir_price = $request->produk_grosir_price;
        $produk_grosir->produk_grosir_note = $request->produk_grosir_note;
        $produk_grosir->save();
        $res = $produk_grosir->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Produk_grosir Not updated!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function destroy($id)
    {
        $status = 200;
        $message = 'Produk_grosir deleted!';
        $res = Produk_grosir::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Produk_grosir Not deleted!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
}
