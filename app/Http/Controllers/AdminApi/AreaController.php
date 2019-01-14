<?php

namespace App\Http\Controllers\AdminApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Province;
use App\Models\City;
use App\Models\Subdistrict;

class AreaController extends Controller
{
	public function province(){
		$status = 200;
		$message = 'Berhasil mendapatkan data provinsi';
		if(!empty($request->id)){
			$data['province'] = Province::where('id', $request->id)->get();
			$data['count'] = $data['province']->count();
		}else{
			$data['province'] = Province::all();
			$data['count'] = $data['province']->count();
		}
		if(!isset($data['province']) || empty($data['province']) || $data['province'] == null){
			$status = 500;
			$message = 'Gagal mendapatkan data provinsi';
		}
        return response()->json(['status' => $status, 'message' => $message, 'data'=>$data]);
	}
	public function city(Request $request){
		$status = 200;
		$message = 'Berhasil mendapatkan data kota';
		if(!empty($request->id)){
			$data['city'] = City::where('city_province_id', $request->id)->get();
			$data['count'] = $data['city']->count();
		}else{
			$data['city'] = City::all();
			$data['count'] = $data['city']->count();
		}
		if(!isset($data['city']) || empty($data['city']) || $data['city'] == null){
			$status = 500;
			$message = 'Gagal mendapatkan data provinsi';
		}
        return response()->json(['status' => $status, 'message' => $message, 'data'=>$data]);
	}
	public function subdistrict(){
		$status = 200;
		$message = 'Berhasil mendapatkan data desa';
		if(!empty($request->id)){
			$data['subdistrict'] = Subdistrict::where('subdistrict_city_id', $request->id)->get();
			$data['count'] = $data['subdistrict']->count();
		}else{
			$data['subdistrict'] = Subdistrict::all();
			$data['count'] = $data['subdistrict']->count();
		}
		if(!isset($data['subdistrict']) || empty($data['subdistrict']) || $data['subdistrict'] == null){
			$status = 500;
			$message = 'Gagal mendapatkan data provinsi';
		}
        return response()->json(['status' => $status, 'message' => $message, 'data'=>$data]);
	}
}