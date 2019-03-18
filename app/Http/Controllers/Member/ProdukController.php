<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Produk;
use App\Role;
use App\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Produk_unit;
use App\Models\Produk_location;
use App\Models\Produk_image;
use App\Models\Produk_grosir;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Auth;
use FunctionLib;


class ProdukController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_produk';

    /**
    *
    * @param
    * @return
    **/
    public function hotlist(Request $request, $id = 0){
        if(!empty($request->all())){
            $this->validate($request, [
                'id' => 'required|numeric',
                'produk_hotlist' => 'required|numeric',
            ]);
            // check wallet and update
            if(FunctionLib::get_hotlist($request->id) >= $request->produk_hotlist){
                // update wallet
                $where = 'wallet_user_id='.Auth::id();
                $where = ' AND wallet_type=6';
                $wallet = Wallet::whereRaw($where)->first();
                $wallet->wallet_ballance_before = $wallet->wallet_ballance;
                $wallet->wallet_ballance = $wallet->wallet_ballance - $request->produk_hotlist;
                $wallet->wallet_note = 'pengurangan saldo hotlist, saldo hotlist telah dipindahkan ke produk.';
                $wallet->save();

                // update produk
                $produk = Produk::whereId($request->id)->first();
                $produk->produk_is_hot = 1;
                $produk->produk_hotlist = $request->produk_hotlist;
                $produk->save();
                $status = 200;
                $message = 'hotlist produk '.$produk->produk_name.' berhasil di tambahkan.';
                Session::flash('flash_status', $status);
                Session::flash('flash_message', $message);
            }else{
                $status = 500;
                $message = 'saldo hotlist anda tidak mencukupi.';
                Session::flash('flash_status', $status);
                Session::flash('flash_message', $message);
            }
        }
        $where = 1;
        $where .= ' AND produk_status=1';
        $where .= ' AND produk_seller_id='.Auth::id();
        if($id != 0){
            $where .= ' AND id='.$id;
        }
        $data['produk'] = Produk::whereRaw($where)->get();
        return view('member.produk.hotlist', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function hot_promo(Request $request)
    {
        $arr = [
            "0" =>'wait',
            "1" =>'active',
            "2" =>'block',
            "0,1,2" =>'',
        ];
        $where = "1 AND produk_is_hot = 1 AND produk_seller_id =".Auth::id();
        if(!empty($request->get('name'))){
            $name = $request->get('name');
            $where .= ' AND produk_name LIKE "%'.$name.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND produk_status IN ('.$status.')';
        }

        if (!empty($where)) {
            $data['produk'] = Produk::where("produk_is_hot", 1)
                ->whereRaw($where)
                ->paginate($this->perPage);
        } else {
            $data['produk'] = Produk::where("produk_is_hot", 1)
                ->paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.hot_promo.hot_promo', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $arr = [
            "0" =>'wait',
            "1" =>'active',
            "2" =>'block',
            "0,1,2" =>'',
        ];
        $where = "1 AND produk_seller_id=".Auth::id();//.' AND produk_user_status=3';
        if(!empty($request->get('name'))){
            $name = $request->get('name');
            $where .= ' AND produk_name LIKE "%'.$name.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND produk_status IN ('.$status.')';
        }

        if (!empty($where)) {
            $data['produk'] = Produk::where("produk_is_hot", 0)
                ->whereRaw($where)
                ->paginate($this->perPage);
        } else {
            $data['produk'] = Produk::where("produk_is_hot", 0)
                ->paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('member.produk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['role'] = Role::all();
        $data['user'] = User::all();
        $data['category'] = Category::all();
        $data['produk_unit'] = Produk_unit::all();
        $data['produk_location'] = Produk_location::all();
        $data['brand'] = Brand::all();
        $id_product = Auth::id();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.produk.create', $data);
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
        $message = 'Produk added!';
        
        $requestData = $request->all();
        // dd($requestData);
        
        $this->validate($request, [
            'produk_name' => 'required',
            'produk_unit' => 'required',
            'produk_price' => 'required|numeric|min:0.00',
            'produk_size' => 'required',
            'produk_length' => 'required|numeric',
            'produk_wide' => 'required|numeric',
            'produk_height' => 'required|numeric',
            'produk_color' => 'required',
            'produk_stock' => 'required|numeric',
            'produk_weight' => 'required|numeric',
            'produk_discount' => 'required|numeric|between:0.00,99.99',
            'produk_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // add produk
        $res = new Produk;
        $res->produk_seller_id = Auth::user()->id;
        $res->produk_category_id = $request->produk_category_id;
        $res->produk_brand_id = $request->produk_brand_id;
        $res->produk_name = $request->produk_name;
        $res->produk_slug = str_slug(Auth::user()->user_store.' '.$request->produk_name.' '.FunctionLib::str_rand(5));
        $res->produk_unit = $request->produk_unit;
        $res->produk_price = $request->produk_price;
        $res->produk_size = implode (",", $request->produk_size);
        $res->produk_length = $request->produk_length;
        $res->produk_wide = $request->produk_wide;
        $res->produk_height = $request->produk_height;
        $res->produk_color = implode (",", $request->produk_color);
        $res->produk_stock = $request->produk_stock;
        $res->produk_weight = $request->produk_weight;
        $res->produk_discount = $request->produk_discount;
        $res->produk_user_status = Auth::user()->roles->first()->id;
        // upload
        if ($request->hasFile('input_file_preview')){
            foreach ($request->file('input_file_preview') as $key => $item) {
                $image = $item;
                $uploadPath = public_path('assets/images/product');
                // $uploadPath2 = public_path('assets/images/brand/thumb');
                $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(5).'.'.$image->getClientOriginalExtension();
                // $imagesize = $image->getClientSize();
                // $imagetmp = $image->getPathName();
                if(file_exists($uploadPath . '/' . $imagename)){// || file_exists($uploadPath . '/thumb' . $imagename)){
                    $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(6).'.'.$image->getClientOriginalExtension();
                }
                $image = Image::make($image->getRealPath())->resize(NULL, 400, function ($constraint) {$constraint->aspectRatio();});
                // $image = Image::make($image->getRealPath())->resize(NULL, 200, function ($constraint) {$constraint->aspectRatio();})->fit(400, 200);
                $image->save($uploadPath.'/'.$imagename);
                $produk_image_image[] = $imagename;
                // $imaget->save($uploadPath2.'/'.$imagename,80);
                if($key == 0){
                    $res->produk_image = $imagename;
                }
            }
        }
        $res->produk_note = $request->produk_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Produk Not added!';
            return redirect('admin/produk')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }else{
            // add produk image
            if ($request->hasFile('input_file_preview')){
                foreach ($produk_image_image as $item) {
                    $produk_image = new Produk_image;
                    $produk_image->produk_image_produk_id = $res->id;
                    $produk_image->produk_image_image = $item;
                    $produk_image->save();
                }
                if(!$produk_image){
                    $status = 500;
                    $message = 'Produk Image Not added!';
                    return redirect('admin/produk')
                        ->with(['flash_status' => $status,'flash_message' => $message]);
                }
            }
            // add grosir
            if ($request->has('produk_grosir_start') && $request->has('produk_grosir_end') && $request->has('produk_grosir_price')){
                foreach ($request->produk_grosir_start as $key => $item) {
                    if($request->produk_grosir_start[$key] == null){
                        break;
                    }
                    $produk_grosir = new Produk_grosir;
                    $produk_grosir->produk_grosir_produk_id = $res->id;
                    $produk_grosir->produk_grosir_start = $request->produk_grosir_start[$key];
                    $produk_grosir->produk_grosir_end = $request->produk_grosir_end[$key];
                    $produk_grosir->produk_grosir_price = $request->produk_grosir_price[$key];
                    $produk_grosir->save();
                }
            }
            return redirect('member/produk')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
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
        $data['produk'] = Produk::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.produk.show', $data);
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
        $data['role'] = Role::all();
        $data['user'] = User::all();
        $data['category'] = Category::all();
        $data['produk_unit'] = Produk_unit::all();
        $data['produk_location'] = Produk_location::all();
        $data['brand'] = Brand::all();
        $data['produk'] = Produk::findOrFail($id);

        $data['asdfku'] = Produk_image::all()->where("produk_image_produk_id", $id)->count();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.produk.edit', $data);
    }

     public function edit_get($id)
    {
        $data = Produk_image::findOrFail($id);
        echo $data;
    }
         public function edit_get_post(Request $request){
        Produk_image::where('produk_image_image', $request->message)->delete();
          return response(['status' => 'success'])
        ->header('Content-Type', 'application/json');
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
        $message = 'Produk updated!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'produk_name' => 'required',
            'produk_unit' => 'required',
            'produk_price' => 'required|numeric|between:0.00,9999999999999.99',
            'produk_size' => 'required',
            'produk_length' => 'required|numeric',
            'produk_wide' => 'required|numeric',
            'produk_height' => 'required|numeric',
            'produk_color' => 'required',
            'produk_stock' => 'required|numeric',
            'produk_weight' => 'required|numeric',
            'produk_discount' => 'required|numeric|between:0.00,99.99',
        ]);

        $produk = Produk::findOrFail($id);
        if($produk->produk_seller_id !== Auth::user()->id || $produk->produk_user_status !== Auth::user()->roles->first()->id){
            $status = 500;
            $message = 'Produk Not updated!';
            return redirect('member/produk')
                ->with(['flash_status' => $status,'flash_message' => $message]);

        }
        $produk->produk_category_id = $request->produk_category_id;
        $produk->produk_brand_id = $request->produk_brand_id;
        $produk->produk_name = $request->produk_name;
        $produk->produk_slug = str_slug(Auth::user()->user_store.' '.$request->produk_name);
        $produk->produk_unit = $request->produk_unit;
        $produk->produk_price = $request->produk_price;
        $produk->produk_size = implode (",", $request->produk_size);
        $produk->produk_length = $request->produk_length;
        $produk->produk_wide = $request->produk_wide;
        $produk->produk_height = $request->produk_height;
        $produk->produk_color = implode (",", $request->produk_color);
        $produk->produk_stock = $request->produk_stock;
        $produk->produk_weight = $request->produk_weight;
        $produk->produk_discount = $request->produk_discount;
        if ($request->hasFile('input_file_choose')){
            $request->produk_image = $request->input_file_choose;
        }
        // upload
        if ($request->hasFile('input_file_preview')){
            foreach ($request->file('input_file_preview') as $key => $item) {
                $image = $item;
                // $imaget = Image::make($image->getRealPath())->resize(NULL, 200, function ($constraint) {$constraint->aspectRatio();})->fit(400, 200);
                $uploadPath = public_path('assets/images/product');
                // $uploadPath2 = public_path('assets/images/brand/thumb');
                $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(5).'.'.$image->getClientOriginalExtension();
                $imagesize = $image->getClientSize();
                $imagetmp = $image->getPathName();
                // exist on db delete image path
                // if(Produk::where('id', '=', "$id")->pluck('produk_image')[0] != ''){
                //     if(file_exists($uploadPath . '/' . Produk::where('id', '=', "$id")->pluck('produk_image')[0])){
                //         File::delete($uploadPath . '/' . Produk::where('id', '=', "$id")->pluck('produk_image')[0]);   
                //     }
                // }
                if(file_exists($uploadPath . '/' . $imagename)){// || file_exists($uploadPath . '/thumb' . $imagename)){
                    $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(6).'.'.$image->getClientOriginalExtension();
                }
                $image->move($uploadPath, $imagename);
                $produk_image_image[] = $imagename;
                // $imaget->save($uploadPath2.'/'.$imagename,80);
                if($produk->images->count() == 0 && $key == 0){
                    $produk->produk_image = $imagename;
                }
            }
        }
        $produk->produk_note = $request->produk_note;
        $produk->save();
        // $res = $produk->update($requestData);
        if(!$produk){
            $status = 500;
            $message = 'Produk Not Updated!';
            return redirect('member/produk')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }else{
            // add produk image
            if ($request->hasFile('input_file_preview')){
                foreach ($produk_image_image as $item) {
                    $produk_image = new Produk_image;
                    $produk_image->produk_image_produk_id = $produk->id;
                    $produk_image->produk_image_image = $item;
                    $produk_image->save();
                }
                if(!$produk_image){
                    $status = 500;
                    $message = 'Produk Image Not added!';
                    return redirect('member/produk')
                        ->with(['flash_status' => $status,'flash_message' => $message]);
                }
            }
            // add grosir
            if ($request->has('produk_grosir_start') && $request->has('produk_grosir_end') && $request->has('produk_grosir_price')){
                foreach ($request->produk_grosir_start as $key => $item) {
                    if($request->produk_grosir_start[$key] == null){
                            break;
                    }
                    $produk_grosir = new Produk_grosir;
                    $produk_grosir->produk_grosir_produk_id = $produk->id;
                    $produk_grosir->produk_grosir_start = $request->produk_grosir_start[$key];
                    $produk_grosir->produk_grosir_end = $request->produk_grosir_end[$key];
                    $produk_grosir->produk_grosir_price = $request->produk_grosir_price[$key];
                    $produk_grosir->save();
                }
            }
            if ($request->has('produk_grosir_start') && $request->has('produk_grosir_end') && $request->has('produk_grosir_price')){
                foreach ($request->produk_grosir_start as $key => $item) {
                    if($request->produk_grosir_start[$key] == null){
                            break;
                    }
                    if(isset($request->produk_grosir_id[$key])){
                        $produk_grosir = Produk_grosir::findOrFail($request->produk_grosir_id[$key]);
                        $produk_grosir->produk_grosir_produk_id = $produk->id;
                        $produk_grosir->produk_grosir_start = $request->produk_grosir_start[$key];
                        $produk_grosir->produk_grosir_end = $request->produk_grosir_end[$key];
                        $produk_grosir->produk_grosir_price = $request->produk_grosir_price[$key];
                        $produk_grosir->save();
                        $grosir_id[]=$request->produk_grosir_id[$key];
                    }else{
                        $produk_grosir = new Produk_grosir;
                        $produk_grosir->produk_grosir_produk_id = $produk->id;
                        $produk_grosir->produk_grosir_start = $request->produk_grosir_start[$key];
                        $produk_grosir->produk_grosir_end = $request->produk_grosir_end[$key];
                        $produk_grosir->produk_grosir_price = $request->produk_grosir_price[$key];
                        $produk_grosir->save();
                        $grosir_id[]=$produk_grosir->id;
                    }
                }
                $user_id = Auth::id();
                $delete_grosir = Produk_grosir::whereNotIn('id', $grosir_id)
                    ->whereHas('produk', function($query) use ($user_id){
                        $query->where('sys_produk.produk_seller_id', $user_id);
                            return $query;
                        })
                    ->delete();
            }
        }
        return redirect('member/produk')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    public function produk_image_delete($id){
        $status = 200;
        $message = 'Produk Image deleted!';
        $res = Produk_image::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Produk Not deleted!';
        }

        if($request->ajax()){
            return response()->json(['flash_status'=>$status, 'flash_message'=>$message]);
        }
        return redirect('member/produk')
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
        $status = 200;
        $message = 'Produk deleted!';
        $res = Produk::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Produk Not deleted!';
        }

        return redirect('member/produk')
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
        $produk = DB::query($qry);

        return $produk;
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
                    <link href="<?php echo  asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css');?>" rel="stylesheet">
                    <script src="<?php echo asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js');?> "></script>
                    <script>
                        $(function () {
                            $('.cp').colorpicker();
                            var no = 1;
                            var addFormGroup = function (event) {
                                event.preventDefault();

                                var $formGroup = $(this).closest('.form-group');
                                var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
                                var $formGroupClone = $formGroup.clone();

                                $(this)
                                    .toggleClass('btn-default btn-add btn-danger btn-remove')
                                    .html('–');

                                $formGroupClone.find('input').val('#00AABB');
                                // $formGroupClone.find('.colorpicker-component').attr('id', 'cp'+ no);
                                $formGroupClone.insertAfter($formGroup);

                                var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
                                if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
                                    $lastFormGroupLast.find('.btn-add').attr('disabled', true);
                                }
                                $('.cp').colorpicker();
                                no++;
                            };
                            var removeFormGroup = function (event) {
                                event.preventDefault();

                                var $formGroup = $(this).closest('.form-group');
                                var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

                                var $lastFormGroupLast = $multipleFormGroup.find('.input-group:last');
                                if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
                                    $lastFormGroupLast.find('.btn-add').attr('disabled', false);
                                }

                                $formGroup.remove();
                                no--;
                            };
                            var countFormGroup = function ($form) {
                                return $form.find('.form-group').length;
                            };
                            $(document).on('click', '.btn-add', addFormGroup);
                            $(document).on('click', '.btn-remove', removeFormGroup);
                        });
                    </script>
                    <script type="text/javascript">
                        $(document).on('click', '#close-preview', function(){ 
                            $(this).parents(".parent-img").find('.image-preview').popover('hide');
                            // Hover befor close the preview
                            $('.image-preview').hover(
                                function () {
                                   $(this).popover('show');
                                }, 
                                 function () {
                                   $(this).popover('hide');
                                }
                            );    
                        });

                        $(function() {
                            // Create the close button
                            var closebtn = $('<button/>', {
                                type:"button",
                                text: 'x',
                                id: 'close-preview',
                                style: 'font-size: initial;',
                            });
                            closebtn.attr("class","close pull-right");
                            // Set the popover default content
                            $('.image-preview').popover({
                                trigger:'manual',
                                html:true,
                                title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                                content: "There's no image",
                                placement:'bottom'
                            });
                            // Clear event
                            $('.image-preview-clear').click(function(){
                                $(this).parents(".parent-img").find('.image-preview').attr("data-content","").popover('hide');
                                $(this).parents(".parent-img").find('.image-preview-filename').val("");
                                $(this).parents(".parent-img").find('.image-preview-clear').hide();
                                $(this).parents(".parent-img").find('.image-preview-input input:file').val("");
                                $(this).parents(".parent-img").find(".image-preview-input-title").text("Browse"); 
                            }); 
                            // Create the preview image
                            $(".image-preview-input input:file").change(function (){     
                                var img = $('<img/>', {
                                    id: 'dynamic',
                                    width:250,
                                    height:200
                                });      
                                var file = this.files[0];
                                var reader = new FileReader();
                                var x = $(this);
                                // Set preview image into the popover data-content
                                reader.onload = function (e) {
                                    $(x).parents(".parent-img").find(".image-preview-input-title").text("Change");
                                    $(x).parents(".parent-img").find(".image-preview-clear").show();
                                    $(x).parents(".parent-img").find(".image-preview-filename").val(file.name);
                                    img.attr('src', e.target.result);
                                    $(x).parents(".parent-img").find(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
                                }        
                                reader.readAsDataURL(file);
                            });  
                        });
                        $("#add-file-field").click(function(){
                            var html = '<div class="parent-img m-t-xs">'+
                            '<div class="input-group image-preview">'+
                                '<input type="text" class="form-control image-preview-filename" disabled="disabled">'+
                                '<span class="input-group-btn">'+
                                    '<button type="button" class="btn btn-default image-preview-clear" style="display:none;">'+
                                        '<span class="glyphicon glyphicon-remove"></span> Clear'+
                                    '</button>'+
                                    '<div class="btn btn-default image-preview-input">'+
                                        '<span class="glyphicon glyphicon-folder-open"></span>'+
                                        '<span class="image-preview-input-title">Browse</span>'+
                                        '<input type="file" accept="image/png, image/jpeg, image/gif" name="input_file_preview[]"/>'+
                                    '</div>'+
                                    '<button type="button" class="btn btn-danger remove-btn">'+
                                        '<span class="glyphicon glyphicon-remove"></span>'+
                                    '</button>'+
                                '</span>'+
                            '</div>'+
                            '</div>';
                            $(".append-img").append(html);
                            $(".remove-btn").click(function() {
                                $(this).parents('.parent-img').remove();
                            });

                            // $(document).on('click', '.close', function(){ 
                            //     console.log($(this).parents('.parent-img'));
                            //     $(this).parents('.popover').hide();
                                // Hover befor close the preview
                                $('.image-preview').hover(
                                    function () {
                                       $(this).popover('show');
                                    }, 
                                     function () {
                                       $(this).popover('hide');
                                    }
                                );    
                            // });

                            $(function() {
                                // Create the close button
                                var closebtn = $('<button/>', {
                                    type:"button",
                                    text: 'x',
                                    id: 'close-preview',
                                    style: 'font-size: initial;',
                                });
                                closebtn.attr("class","close pull-right");
                                // Set the popover default content
                                $('.image-preview').popover({
                                    trigger:'manual',
                                    html:true,
                                    title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                                    content: "There's no image",
                                    placement:'bottom'
                                });
                                // Clear event
                                $('.image-preview-clear').click(function(){
                                    $(this).parents(".parent-img").find('.image-preview').attr("data-content","").popover('hide');
                                    $(this).parents(".parent-img").find('.image-preview-filename').val("");
                                    $(this).parents(".parent-img").find('.image-preview-clear').hide();
                                    $(this).parents(".parent-img").find('.image-preview-input input:file').val("");
                                    $(this).parents(".parent-img").find(".image-preview-input-title").text("Browse"); 
                                }); 
                                // Create the preview image
                                $(".image-preview-input input:file").change(function (){     
                                    var img = $('<img/>', {
                                        id: 'dynamic',
                                        width:250,
                                        height:200
                                    });      
                                    var file = this.files[0];
                                    var reader = new FileReader();
                                    var x = $(this);
                                    // Set preview image into the popover data-content
                                    reader.onload = function (e) {
                                        $(x).parents(".parent-img").find(".image-preview-input-title").text("Change");
                                        $(x).parents(".parent-img").find(".image-preview-clear").show();
                                        $(x).parents(".parent-img").find('.image-preview-filename').val(file.name);            
                                        img.attr('src', e.target.result);
                                        $(x).parents(".parent-img").find(".image-preview").attr("data-content",$(img)[0].outerHTML);
                                    }        
                                    reader.readAsDataURL(file);
                                });  
                            });
                        });

                        var clicks = 1;
                        function add_grosir_row() {
                            clicks += 1;
                            if (clicks < 6) {
                                $("#grosir_row").append(
                                    '<tr id="row_"' + clicks + '>'+
                                    '<td style="width: 20%">'+
                                    '<input class="form-control" type="number" name="produk_grosir_start[]" >'+
                                    '<i class="btn-block bg-danger m-t-xs">Harus berupa angka</i>'+
                                    '</td>'+
                                    '<td style="width: 20%">'+
                                    '<input class="form-control" type="number" name="produk_grosir_end[]" class="radius" >'+
                                    '<i class="btn-block bg-danger m-t-xs">Harus berupa angka</i>'+
                                    '</td>'+
                                    '<td style="width: 50%">'+
                                    '<input class="form-control" type="number" name="produk_grosir_price[]" class="radius" >'+
                                    '<i class="btn-block bg-danger m-t-xs">Harus berupa angka</i>'+
                                    '</td>'+
                                    '<td class="text-center">'+
                                    '<a class="btn btn-xs btn-danger remove_grosir">'+
                                    '<i class="fa fa-minus"></i>'+
                                    '</a>'+
                                    '</td>'+
                                    '</tr>'
                                );
                            } else {
                                clicks -= 1;
                                $(".add_grosir_row").hide();
                            }
                            $(".remove_grosir").on("click", function(){
                                clicks -= 1;
                                $(this).parents("tr").remove();
                                $(".add_grosir_row").show();
                            })
                        }
                    </script>
                <?php
                break;
            case 'show':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'edit':
                ?>
                    <link href="<?php echo  asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css');?>" rel="stylesheet">
                    <script src="<?php echo asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js');?> "></script>
                    <script>
                        $(function () {
                            $('.cp').colorpicker();
                            var no = 1;
                            var addFormGroup = function (event) {
                                event.preventDefault();

                                var $formGroup = $(this).closest('.form-group');
                                var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
                                var $formGroupClone = $formGroup.clone();

                                $(this)
                                    .toggleClass('btn-default btn-add btn-danger btn-remove')
                                    .html('–');

                                $formGroupClone.find('input').val('#00AABB');
                                // $formGroupClone.find('.colorpicker-component').attr('id', 'cp'+ no);
                                $formGroupClone.insertAfter($formGroup);

                                var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
                                if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
                                    $lastFormGroupLast.find('.btn-add').attr('disabled', true);
                                }
                                $('.cp').colorpicker();
                                no++;
                            };
                            var removeFormGroup = function (event) {
                                event.preventDefault();

                                var $formGroup = $(this).closest('.form-group');
                                var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

                                var $lastFormGroupLast = $multipleFormGroup.find('.input-group:last');
                                if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
                                    $lastFormGroupLast.find('.btn-add').attr('disabled', false);
                                }

                                $formGroup.remove();
                                no--;
                            };
                            var countFormGroup = function ($form) {
                                return $form.find('.form-group').length;
                            };
                            $(document).on('click', '.btn-add', addFormGroup);
                            $(document).on('click', '.btn-remove', removeFormGroup);
                        });
                    </script>
                    <script type="text/javascript">
                        $(document).on('click', '#close-preview', function(){ 
                            $(this).parents(".parent-img").find('.image-preview').popover('hide');
                            // Hover befor close the preview
                            $('.image-preview').hover(
                                function () {
                                   $(this).popover('show');
                                }, 
                                 function () {
                                   $(this).popover('hide');
                                }
                            );    
                        });

                        $(function() {
                            // Create the close button
                            var closebtn = $('<button/>', {
                                type:"button",
                                text: 'x',
                                id: 'close-preview',
                                style: 'font-size: initial;',
                            });
                            closebtn.attr("class","close pull-right");
                            // Set the popover default content
                            $('.image-preview').popover({
                                trigger:'manual',
                                html:true,
                                title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                                content: "There's no image",
                                placement:'bottom'
                            });
                            // Clear event
                            $('.image-preview-clear').click(function(){
                                $(this).parents(".parent-img").find('.image-preview').attr("data-content","").popover('hide');
                                $(this).parents(".parent-img").find('.image-preview-filename').val("");
                                $(this).parents(".parent-img").find('.image-preview-clear').hide();
                                $(this).parents(".parent-img").find('.image-preview-input input:file').val("");
                                $(this).parents(".parent-img").find(".image-preview-input-title").text("Browse"); 
                            }); 
                            // Create the preview image
                            $(".image-preview-input input:file").change(function (){     
                                var img = $('<img/>', {
                                    id: 'dynamic',
                                    width:250,
                                    height:200
                                });      
                                var file = this.files[0];
                                var reader = new FileReader();
                                var x = $(this);
                                // Set preview image into the popover data-content
                                reader.onload = function (e) {
                                    $(x).parents(".parent-img").find(".image-preview-input-title").text("Change");
                                    $(x).parents(".parent-img").find(".image-preview-clear").show();
                                    $(x).parents(".parent-img").find(".image-preview-filename").val(file.name);
                                    img.attr('src', e.target.result);
                                    $(x).parents(".parent-img").find(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
                                }        
                                reader.readAsDataURL(file);
                            });  
                        });
                        $("#add-file-field").click(function(){
                            var html = '<div class="parent-img m-t-xs">'+
                            '<div class="input-group image-preview">'+
                                '<input type="text" class="form-control image-preview-filename" disabled="disabled">'+
                                '<span class="input-group-btn">'+
                                    '<button type="button" class="btn btn-default image-preview-clear" style="display:none;">'+
                                        '<span class="glyphicon glyphicon-remove"></span> Clear'+
                                    '</button>'+
                                    '<div class="btn btn-default image-preview-input">'+
                                        '<span class="glyphicon glyphicon-folder-open"></span>'+
                                        '<span class="image-preview-input-title">Browse</span>'+
                                        '<input type="file" accept="image/png, image/jpeg, image/gif" name="input_file_preview[]"/>'+
                                    '</div>'+
                                    '<button type="button" class="btn btn-danger remove-btn">'+
                                        '<span class="glyphicon glyphicon-remove"></span>'+
                                    '</button>'+
                                '</span>'+
                            '</div>'+
                            '</div>';
                            $(".append-img").append(html);
                            $(".remove-btn").click(function() {
                                $(this).parents('.parent-img').remove();
                            });

                            // $(document).on('click', '.close', function(){ 
                            //     console.log($(this).parents('.parent-img'));
                            //     $(this).parents('.popover').hide();
                                // Hover befor close the preview
                                $('.image-preview').hover(
                                    function () {
                                       $(this).popover('show');
                                    }, 
                                     function () {
                                       $(this).popover('hide');
                                    }
                                );    
                            // });

                            $(function() {
                                // Create the close button
                                var closebtn = $('<button/>', {
                                    type:"button",
                                    text: 'x',
                                    id: 'close-preview',
                                    style: 'font-size: initial;',
                                });
                                closebtn.attr("class","close pull-right");
                                // Set the popover default content
                                $('.image-preview').popover({
                                    trigger:'manual',
                                    html:true,
                                    title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                                    content: "There's no image",
                                    placement:'bottom'
                                });
                                // Clear event
                                $('.image-preview-clear').click(function(){
                                    $(this).parents(".parent-img").find('.image-preview').attr("data-content","").popover('hide');
                                    $(this).parents(".parent-img").find('.image-preview-filename').val("");
                                    $(this).parents(".parent-img").find('.image-preview-clear').hide();
                                    $(this).parents(".parent-img").find('.image-preview-input input:file').val("");
                                    $(this).parents(".parent-img").find(".image-preview-input-title").text("Browse"); 
                                }); 
                                // Create the preview image
                                $(".image-preview-input input:file").change(function (){     
                                    var img = $('<img/>', {
                                        id: 'dynamic',
                                        width:250,
                                        height:200
                                    });      
                                    var file = this.files[0];
                                    var reader = new FileReader();
                                    var x = $(this);
                                    // Set preview image into the popover data-content
                                    reader.onload = function (e) {
                                        $(x).parents(".parent-img").find(".image-preview-input-title").text("Change");
                                        $(x).parents(".parent-img").find(".image-preview-clear").show();
                                        $(x).parents(".parent-img").find('.image-preview-filename').val(file.name);            
                                        img.attr('src', e.target.result);
                                        $(x).parents(".parent-img").find(".image-preview").attr("data-content",$(img)[0].outerHTML);
                                    }        
                                    reader.readAsDataURL(file);
                                });  
                            });
                        });

                        $('.img-check').click(function(e) {
                            $('.img-check').not(this).removeClass('img-checked')
                                .siblings('input').prop('checked',false);
                            $(this).addClass('img-checked')
                                .siblings('input').prop('checked',true);
                        });
                        var clicks = 0;
                        $(".remove_grosir").on("click", function(){
                            clicks -= 1;
                            $(this).parents("tr").remove();
                            $(".add_grosir_row").show();
                        })
                        function add_grosir_row() {
                            clicks += 1;
                            if (clicks < 6) {
                                $("#grosir_row").append(
                                    '<tr id="row_"' + clicks + '>'+
                                    '<td style="width: 20%">'+
                                    '<input class="form-control" type="number" name="produk_grosir_start[]" >'+
                                    '<i class="btn-block bg-danger m-t-xs">Harus berupa angka</i>'+
                                    '</td>'+
                                    '<td style="width: 20%">'+
                                    '<input class="form-control" type="number" name="produk_grosir_end[]" class="radius" >'+
                                    '<i class="btn-block bg-danger m-t-xs">Harus berupa angka</i>'+
                                    '</td>'+
                                    '<td style="width: 50%">'+
                                    '<input class="form-control" type="number" name="produk_grosir_price[]" class="radius" >'+
                                    '<i class="btn-block bg-danger m-t-xs">Harus berupa angka</i>'+
                                    '</td>'+
                                    '<td class="text-center">'+
                                    '<a class="btn btn-xs btn-danger remove_grosir">'+
                                    '<i class="fa fa-minus"></i>'+
                                    '</a>'+
                                    '</td>'+
                                    '</tr>'
                                );
                            } else {
                                clicks -= 1;
                                $(".add_grosir_row").hide();
                            }
                            $(".remove_grosir").on("click", function(){
                                clicks -= 1;
                                $(this).parents("tr").remove();
                                $(".add_grosir_row").show();
                            })
                        }
                    </script>
                <?php
                break;
        }
        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
