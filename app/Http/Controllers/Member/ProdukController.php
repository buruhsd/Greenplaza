<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Produk;
use App\Role;
use App\User;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;


class ProdukController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_produk';

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
        $data['brand'] = Brand::all();
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
        dd($requestData);
        
        $this->validate($request, [
            'produk_name' => 'required',
            'produk_unit' => 'required',
            'produk_price' => 'required',
            'produk_size' => 'required',
            'produk_length' => 'required',
            'produk_wide' => 'required',
            'produk_color' => 'required',
            'produk_stock' => 'required',
            'produk_weight' => 'required',
            'produk_discount' => 'required',
            'produk_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $res = new Produk;
        $res->produk_seller_id = Auth::user()->id;
        $res->produk_category_id = $request->produk_category_id;
        $res->produk_brand_id = $request->produk_brand_id;
        $res->produk_name = $request->produk_name;
        $res->produk_slug = str_slug(Auth::user()->user_store.' '.$request->produk_name);
        $res->produk_unit = $request->produk_unit;
        $res->produk_price = $request->produk_price;
        $res->produk_size = $request->produk_size;
        $res->produk_length = $request->produk_length;
        $res->produk_wide = $request->produk_wide;
        $res->produk_color = $request->produk_color;
        $res->produk_stock = $request->produk_stock;
        $res->produk_weight = $request->produk_weight;
        $res->produk_discount = $request->produk_discount;
        // upload
        if ($request->hasFile('produk_image')){
            $image = $request->file('produk_image');
            // $imaget = Image::make($image->getRealPath())->resize(NULL, 200, function ($constraint) {$constraint->aspectRatio();})->fit(400, 200);
            $uploadPath = public_path('assets/images/product');
            // $uploadPath2 = public_path('assets/images/brand/thumb');
            $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(5).'.'.$image->getClientOriginalExtension();
            $imagesize = $image->getClientSize();
            $imagetmp = $image->getPathName();
            if(file_exists($uploadPath . '/' . $imagename)){// || file_exists($uploadPath . '/thumb' . $imagename)){
                $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(6).'.'.$image->getClientOriginalExtension();
            }
            $image->move($uploadPath, $imagename);
            // $imaget->save($uploadPath2.'/'.$imagename,80);
            $res->produk_image = $imagename;
        }
        $res->produk_note = $request->produk_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Produk Not added!';
        }
        return redirect('admin/produk')
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
        $data['brand'] = Brand::all();
        $data['produk'] = Produk::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.produk.edit', $data);
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
        $produk->produk_image = date("d-M-Y_H-i-s").'_'.$request->produk_image->getClientOriginalName();
        $request->produk_image->move(public_path('assets/images/product'),$produk->produk_image);
        $produk->produk_note = $request->produk_note;
        $produk->save();
        $res = $produk->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Produk Not updated!';
        }

        return redirect('admin/produk')
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

        return redirect('admin/produk')
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
                                        '<input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview[]"/>'+
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

                        // $(document).ready(function(){
                        //     $(document).on('change', '.btn-file :file', function() {
                        //         var input = $(this),
                        //         label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                        //         input.trigger('fileselect', [label]);
                        //     });
                        //     $('.btn-file :file').on('fileselect', function(event, label) {
                        //         console.log(label);
                        //         var input = $(this).parents('.input-group').find(':text'),
                        //         log = label;
                        //         if( input.length ) {
                        //             input.val(log);
                        //         } else {
                        //             if( log ) alert(log);
                        //         }
                        //     });
                        //     function readURL(input) {
                        //         if (input.files && input.files[0]) {
                        //             var reader = new FileReader();

                        //             reader.onload = function (e) {
                        //                 // $('#img-upload').attr('src', e.target.result);
                        //                 // console.log($(input).parent().parent().parent().parent().parent("div .img-thumb"));
                        //                 // .parent('.img-thumb').attr('src', e.target.result);
                        //                 $(input).parents('.added-field').find('.img-thumb').attr('src', e.target.result);
                        //             }
                        //             reader.readAsDataURL(input.files[0]);
                        //         }
                        //     }
                        //     $("#imgInp").change(function(){
                        //         readURL(this);
                        //     });

                        //     // This will add new input field
                        //     $("#add-file-field").click(function(){
                        //         var html = '<div class="added-field">'+
                        //             '<div class="col-md-9">'+
                        //                 '<div class="input-group">'+
                        //                     '<span class="input-group-btn">'+
                        //                         '<span class="btn btn-default btn-file">'+
                        //                             'Browse… <input type="file" name="produk_image[]" id="imgInp">'+
                        //                         '</span>'+
                        //                     '</span>'+
                        //                     '<input type="text" class="form-control" readonly>'+
                        //                     '<span class="input-group-btn">'+
                        //                         '<input type="button" class="remove-btn form-control" value="X"/>'+
                        //                     '</span>'+
                        //                 '</div>'+
                        //             '</div>'+
                        //             '<div class="col-md-3">'+
                        //                 '<img class="h50 img-thumb"/>'+
                        //             '</div>'+
                        //         '</div>';
                        //         $("#append-upload").append(html);
                        //         $(".remove-btn").click(function() {
                        //             $(this).parents('.added-field').remove();
                        //         });
                        //     });
                        //     // The live function binds elements which are added to the DOM at later time
                        //     // So the newly added field can be removed too
                        // });
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
                    <script type="text/javascript"></script>
                <?php
                break;
        }
        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
