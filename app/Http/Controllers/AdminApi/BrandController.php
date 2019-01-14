<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_brand';

    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['brand'] = Brand::paginate($this->perPage);
        } else {
            $data['brand'] = Brand::paginate($this->perPage);
        }
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function store(Request $request)
    {
        $status = 200;
        $message = 'Brand added!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'brand_name' => 'required',
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brand_note' => 'required',
            
        ]);
        $res = new Brand;
        $res->brand_name = $request->brand_name;
        $res->brand_image = date("d-M-Y_H-i-s").'_'.$request->brand_image->getClientOriginalName();
        $request->brand_image->move(public_path('assets/images/brand'),$res->brand_image);
        $res->brand_slug = $request->brand_slug;
        $res->brand_note = $request->brand_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Brand Not added!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function show($id)
    {
        $data['brand'] = Brand::findOrFail($id);
        return response()->json(['success' => true, 'data'=>$data]);
    }
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Brand added!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'brand_name' => 'required',
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brand_note' => 'required',
            
        ]);
        $brand = Brand::findOrFail($id);
        $brand->brand_name = $request->brand_name;
        $brand->brand_image = date("d-M-Y_H-i-s").'_'.$request->brand_image->getClientOriginalName();
        $request->brand_image->move(public_path('assets/images/brand'),$res->brand_image);
        $brand->brand_slug = $request->brand_slug;
        $brand->brand_note = $request->brand_note;
        $brand->save();
        $res = $brand->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Brand Not updated!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
    public function destroy($id)
    {
        $status = 200;
        $message = 'Brand deleted!';
        $res = Brand::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Brand Not deleted!';
        }
        return response()->json(['message'=>$message, 'status'=>$status]);
    }
}
