<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk_location;

class Produk_locationController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'conf_produk_location';

    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['produk_location'] = Produk_location::paginate($this->perPage);
        } else {
            $data['produk_location'] = Produk_location::paginate($this->perPage);
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function store(Request $request)
    {
        $status = 200;
        $message = 'Produk_location added!';
        
        $requestData = $request->all();
        
        $res = new Produk_location;
        $res->produk_location_name = $request->produk_location_name;
        $res->produk_location_note = $request->produk_location_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Produk_location Not added!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function show($id)
    {
        $data['produk_location'] = Produk_location::findOrFail($id);
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Produk_location added!';
        
        $requestData = $request->all();
        
        $produk_location = Produk_location::findOrFail($id);
        $produk_location->produk_location_name = $request->produk_location_name;
        $produk_location->produk_location_note = $request->produk_location_note;
        $produk_location->save();
        $res = $produk_location->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Produk_location Not updated!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function destroy($id)
    {
        $status = 200;
        $message = 'Produk_location deleted!';
        $res = Produk_location::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Produk_location Not deleted!';
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
}
