<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Brand;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use FunctionLib;


class BrandController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_brand';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['brand'] = Brand::paginate($this->perPage);
        } else {
            $data['brand'] = Brand::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('admin.brand.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.brand.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $status = 200;
        $message = 'Brand added!';
        
        $requestData = $request->all();
        $this->validate($request, [
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brand_name' => 'required|unique:sys_brand',
            // 'brand_slug' => 'required',
            // 'brand_note' => 'required',
        ]);
        
        $res = new Brand;
        $res->brand_name = $request->brand_name;
        // upload
        if ($request->hasFile('brand_image')){
            $image = $request->file('brand_image');
            // $imaget = Image::make($image->getRealPath())->resize(NULL, 200, function ($constraint) {$constraint->aspectRatio();})->fit(400, 200);
            $uploadPath = public_path('assets/images/brand');
            // $uploadPath2 = public_path('assets/images/brand/thumb');
            $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(5).'.'.$image->getClientOriginalExtension();
            $imagesize = $image->getClientSize();
            $imagetmp = $image->getPathName();
            if(file_exists($uploadPath . '/' . $imagename)){// || file_exists($uploadPath . '/thumb' . $imagename)){
                $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(6).'.'.$image->getClientOriginalExtension();
            }
            $image->move($uploadPath, $imagename);
            // $imaget->save($uploadPath2.'/'.$imagename,80);
            $res->brand_image = $imagename;
        }

        $res->brand_slug = str_slug($request->brand_name);
        $res->brand_status = 0;
        $res->brand_note = $request->brand_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Brand Not added!';
        }
        return redirect('admin/brand')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['brand'] = Brand::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.brand.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data['brand'] = Brand::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.brand.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Brand added!';
        
        $requestData = $request->all();
        // upload
        if ($request->hasFile('brand_image')){
            $image = $request->file('brand_image');
            // $imaget = Image::make($image->getRealPath())->resize(NULL, 200, function ($constraint) {$constraint->aspectRatio();})->fit(400, 200);
            $uploadPath = public_path('assets/images/brand');
            // $uploadPath2 = public_path('assets/images/brand/thumb');
            $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(5).'.'.$image->getClientOriginalExtension();
            $imagesize = $image->getClientSize();
            $imagetmp = $image->getPathName();
            if(Brand::where('id', '=', "$id")->pluck('brand_image')[0] != ''){
                File::delete($uploadPath . '/' . Brand::where('id', '=', "$id")->pluck('brand_image')[0]);   
            }
            if(file_exists($uploadPath . '/' . $imagename)){// || file_exists($uploadPath . '/thumb' . $imagename)){
                $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(6).'.'.$image->getClientOriginalExtension();
            }
            // if(Brand::where('id', '=', "$id")->pluck('brand_image')[0] != ''){
            //     File::delete($uploadPath2 . '/' . Brand::where('id', '=', "$id")->pluck('brand_image')[0]);   
            // }
            $image->move($uploadPath, $imagename);
            // $imaget->save($uploadPath2.'/'.$imagename,80);
            $requestData['brand_image'] = $imagename;
        }else{
            $requestData['brand_image'] = Brand::where('id', '=', "$id")->pluck('brand_image')[0];
        }
        
        $brand = Brand::findOrFail($id);
        $res = $brand->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Brand Not updated!';
        }

        return redirect('admin/brand')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $uploadPath = public_path('assets/images/brand');
        $image = Brand::where('id', '=', "$id")->pluck('brand_image')[0];
        $status = 200;
        $message = 'Brand deleted!';
        $res = Brand::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Brand Not deleted!';
        }
        $image_path = $uploadPath . '/' . $image;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        return redirect('admin/brand')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param $where
    * @return
    */
    public function get_one_row($where='1', $join=array()){
        $qry = 'SELECT * FROM '.$this->mainTable;
        if(!empty($join)){
            foreach ($join as $value) {
                $qry .= $value;
            }
        }
        $qry .= ' WHERE '.$where.' Limit 1';
        $brand = DB::query($qry);

        return $brand;
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function footer_script($method=''){
        ob_start();
        ?>
            <script type="text/javascript"></script>
        <?php
        switch ($method) {
            case 'index':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'create':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'show':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'edit':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
        }
        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
