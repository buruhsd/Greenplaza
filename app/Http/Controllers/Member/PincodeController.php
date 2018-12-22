<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Trans_pincode;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;
use FunctionLib;


class ProdukController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_produk';

    /**
     * @param
     * @return \Illuminate\View\View
     */
    public function list(Request $request)
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
    public function buy_pincode()
    {
        $data['pincode'] = Trans_pincode::all();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.pincode.buy_pincode', $data);
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
        $res->produk_slug = str_slug(Auth::user()->user_store.' '.$request->produk_name);
        $res->produk_unit = $request->produk_unit;
        $res->produk_price = $request->produk_price;
        $res->produk_size = implode (",", $request->produk_size);
        $res->produk_length = $request->produk_length;
        $res->produk_wide = $request->produk_wide;
        $res->produk_color = implode (",", $request->produk_color);
        $res->produk_stock = $request->produk_stock;
        $res->produk_weight = $request->produk_weight;
        $res->produk_discount = $request->produk_discount;
        $res->produk_user_status = Auth::user()->roles->first()->id;
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
                if(file_exists($uploadPath . '/' . $imagename)){// || file_exists($uploadPath . '/thumb' . $imagename)){
                    $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(6).'.'.$image->getClientOriginalExtension();
                }
                $image->move($uploadPath, $imagename);
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
            // add grosir
            if ($request->has('produk_grosir_start') && $request->has('produk_grosir_end') && $request->has('produk_grosir_price')){
                foreach ($request->produk_grosir_start as $key => $item) {
                    $produk_grosir = new Produk_grosir;
                    $produk_grosir->produk_grosir_produk_id = $res->id;
                    $produk_grosir->produk_grosir_start = $request->produk_grosir_start[$key];
                    $produk_grosir->produk_grosir_end = $request->produk_grosir_end[$key];
                    $produk_grosir->produk_grosir_price = $request->produk_grosir_price[$key];
                    $produk_grosir->save();
                }
            }
            return redirect('admin/produk')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
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
                    </script>
                <?php
                break;
        }
        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
