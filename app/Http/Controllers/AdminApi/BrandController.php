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
}
