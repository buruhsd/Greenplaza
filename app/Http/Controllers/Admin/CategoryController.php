<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Category;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use FunctionLib;


class CategoryController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_category';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['category'] = Category::paginate($this->perPage);
        } else {
            $data['category'] = Category::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['category_par'] = Category::all();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.category.create', $data);
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
        $message = 'Category added!';
        
        $requestData = $request->all();
        $this->validate($request, [
            // 'category_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_name' => 'required',
        ]);
        
        $res = new Category;
        $res->category_parent_id = $request->category_parent_id;
        $res->category_name = $request->category_name;
        // upload
        if ($request->hasFile('category_icon')){
            $icon = $request->file('category_icon');
            // $imaget = Image::make($image->getRealPath())->resize(NULL, 200, function ($constraint) {$constraint->aspectRatio();})->fit(400, 200);
            $uploadPath = public_path('img_category_icon');
            // $uploadPath2 = public_path('assets/images/brand/thumb');
            $iconname = FunctionLib::str_rand(5).'.'.$icon->getClientOriginalExtension();
            $iconsize = $icon->getClientSize();
            $icontmp = $icon->getPathName();
            if(file_exists($uploadPath . '/' . $iconname)){// || file_exists($uploadPath . '/thumb' . $imagename)){
                $iconname = FunctionLib::str_rand(6).'.'.$icon->getClientOriginalExtension();
            }
            $icon->move($uploadPath, $iconname);
            // $imaget->save($uploadPath2.'/'.$imagename,80);
            $res->category_icon = $iconname;
        }
        // upload
        if ($request->hasFile('category_image')){
            $image = $request->file('category_image');
            // $imaget = Image::make($image->getRealPath())->resize(NULL, 200, function ($constraint) {$constraint->aspectRatio();})->fit(400, 200);
            $uploadPath = public_path('assets/images/category_image');
            // $uploadPath2 = public_path('assets/images/brand/thumb');
            $imagename = FunctionLib::str_rand(5).'.'.$image->getClientOriginalExtension();
            $imagesize = $image->getClientSize();
            $imagetmp = $image->getPathName();
            if(file_exists($uploadPath . '/' . $imagename)){// || file_exists($uploadPath . '/thumb' . $imagename)){
                $imagename = FunctionLib::str_rand(6).'.'.$image->getClientOriginalExtension();
            }
            $image->move($uploadPath, $imagename);
            // $imaget->save($uploadPath2.'/'.$imagename,80);
            $res->category_image = $imagename;
        }

        if ($request->category_name)
        {
            $category = Category::where('category_name', $request->category_name)->first();
            if ($category){
                $res->category_slug = str_slug($request->category_name)."-".Auth::User()->name;
                $res->save();
            } else{
                $res->category_slug = str_slug($request->category_name);
                $res->save();
            }
        }
        
        
        $res->category_note = $request->category_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Category Not added!';
        }
        return redirect('admin/category')
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
        $data['category'] = Category::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.category.show', $data);
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
        $data['category_par'] = Category::all();
        $data['category'] = Category::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.category.edit', $data);
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
        $message = 'Category added!';
        
        $requestData = $request->all();
        
        $category = Category::findOrFail($id);
        $category->category_parent_id = $request->category_parent_id;
        $category->category_name = $request->category_name;
        $category->category_note = $request->category_note;
        $category->save();
        $res = $category->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Category Not updated!';
        }

        return redirect('admin/category')
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
        $uploadPath = public_path('img_category_icon');
        $icon = Category::where('id', '=', "$id")->pluck('category_icon')[0];
        $uploadPath2 = public_path('assets/images/category_image');
        $image = Category::where('id', '=', "$id")->pluck('category_image')[0];

        $status = 200;
        $message = 'Category deleted!';
        $res = Category::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Category Not deleted!';

            $icon_path = $uploadPath . '/' . $icon;  // Value is not URL but directory file path
            $image_path = $uploadPath2 . '/' . $image;  // Value is not URL but directory file path
            if(File::exists($icon_path)) {
                File::delete($icon_path);
            }
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }

        return redirect('admin/category')
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
        $category = DB::query($qry);

        return $category;
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
