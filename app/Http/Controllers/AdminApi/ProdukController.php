<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk;

class ProdukController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_produk';

    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['produk'] = Produk::with(['user_detail'])->paginate($this->perPage);
        } else {
            $data['produk'] = Produk::with(['user_detail'])->paginate($this->perPage);
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function store(Request $request)
    {
        $status = 200;
        $message = 'Produk added!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'produk_seller_id' => 'required',
            'produk_name' => 'required',
            'produk_slug' => 'required',
            'produk_unit' => 'required',
            'produk_price' => 'required',
            'produk_size' => 'required',
            'produk_length' => 'required',
            'produk_wide' => 'required',
            'produk_color' => 'required',
            'produk_stock' => 'required',
            'produk_weight' => 'required',
            'produk_discount' => 'required',
            'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->produk_image;
        $imageInfo = explode(";base64,", $image);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);      
        $image = str_replace(' ', '+', $imageInfo[1]);
        $imageName = time().".".$imgExt;
        \File::put(public_path(). '/assets/images/' . $imageName, base64_decode($image));

        // var_dump($imageName); die();

        $res = new Produk;
        $res->produk_seller_id = $request->produk_seller_id;
        $res->produk_category_id = $request->produk_category_id;
        $res->produk_brand_id = '1';
        $res->produk_name = $request->produk_name;
        $res->produk_slug = $request->produk_slug;
        $res->produk_unit = $request->produk_unit;
        $res->produk_price = $request->produk_price;
        $res->produk_size = $request->produk_size;
        $res->produk_length = $request->produk_length;
        $res->produk_wide = $request->produk_wide;
        $res->produk_color = $request->produk_color;
        $res->produk_stock = $request->produk_stock;
        $res->produk_weight = $request->produk_weight;
        $res->produk_discount = $request->produk_discount;
        // $res->produk_image = date("d-M-Y_H-i-s").'_'.$request->produk_image->getClientOriginalName();
        // $request->produk_image->move(public_path('assets/images/product'),$res->produk_image);
        $res->produk_image = $imageName;
        $res->produk_note = $request->produk_note;
        // var_dump($res); die();
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Produk Not added!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function show($id)
    {
        $data['produk'] = Produk::findOrFail($id);
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Produk added!';
        
        $requestData = $request->all();
        $this->validate($request, [
            'produk_seller_id' => 'required',
            'produk_name' => 'required',
            'produk_slug' => 'required',
            'produk_unit' => 'required',
            'produk_price' => 'required',
            'produk_size' => 'required',
            'produk_length' => 'required',
            'produk_wide' => 'required',
            'produk_color' => 'required',
            'produk_stock' => 'required',
            'produk_weight' => 'required',
            'produk_discount' => 'required',
            'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->produk_image;
        $imageInfo = explode(";base64,", $image);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);      
        $image = str_replace(' ', '+', $imageInfo[1]);
        $imageName = time().".".$imgExt;
        \File::put(public_path(). '/assets/images/' . $imageName, base64_decode($image));
        $produk = Produk::findOrFail($id);
        $produk->produk_seller_id = $request->produk_seller_id;
        $produk->produk_category_id = $request->produk_category_id;
        $produk->produk_brand_id = $request->produk_brand_id;
        $produk->produk_name = $request->produk_name;
        $produk->produk_slug = $request->produk_slug;
        $produk->produk_unit = $request->produk_unit;
        $produk->produk_price = $request->produk_price;
        $produk->produk_size = $request->produk_size;
        $produk->produk_length = $request->produk_length;
        $produk->produk_wide = $request->produk_wide;
        $produk->produk_color = $request->produk_color;
        $produk->produk_stock = $request->produk_stock;
        $produk->produk_weight = $request->produk_weight;
        $produk->produk_discount = $request->produk_discount;
        // $produk->produk_image = date("d-M-Y_H-i-s").'_'.$request->produk_image->getClientOriginalName();
        // $request->produk_image->move(public_path('assets/images/product'),$produk->produk_image);
        $res->produk_image = $imageName;
        $produk->produk_note = $request->produk_note;
        $produk->save();
        $res = $produk->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Produk Not updated!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function destroy($id)
    {
        $status = 200;
        $message = 'Produk deleted!';
        $res = Produk::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Produk Not deleted!';
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
}
