<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Paket_iklan;
use App\Models\Trans_iklan;
use App\Models\Iklan;
use App\Models\Category;
use App\User;
use Session;
use Auth;
use FunctionLib;

class IklanController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_iklan';

    /**
     * #buyer
     * process buyer mengkonfirmasi pembayaran
     * @param
     * @return
     */
    public function konfirmasi($id){
        $status = 200;
        $message = 'Transfer confirmed!';
        $trans = Trans_iklan::findOrFail($id);
        $status = FunctionLib::midtrans_status($trans->trans_iklan_code);
        if($status){
            $trans->trans_iklan_status = 1;
            $trans->save();
            $status = 200;
            $message = 'You has been Transfered!';
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }else{
            $data['trans'] = $trans;
            return view('member.iklan.konfirmasi', $data)->with(['flash_status' => $status,'flash_message' => $message]);
        }
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function list(){
        return view('member.pincode.tagihan');
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function add_baris(Request $request){
        $requestData = $request->all();
        if(!empty($requestData)){
        // dd($requestData);
            $this->validate($request, [
                'iklan_title' => 'required',
                'iklan_category_id' => 'required',
                'iklan_content' => 'required',
            ]);
            $iklan = new Iklan;
            $iklan->iklan_iklan_id = $request->iklan_iklan_id;
            $iklan->iklan_user_id = Auth::id();
            $iklan->iklan_title = $request->iklan_title;
            $iklan->iklan_status = 1;
            $iklan->iklan_category_id = $request->iklan_category_id;
            if($request->is_link == 1){
                $iklan->iklan_link = $request->iklan_link;
            }
            $iklan->iklan_content = $request->iklan_content;
            $iklan->iklan_note = 'Pembelian iklan baris oleh '.Auth::user()->username.' pada '.date('Y-m-d H:i:s');
            $iklan->save();
            // dd($iklan);
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        $data['category'] = Category::all();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.iklan.add_baris', $data);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function baris(){
        $where = 1;
        $where .= ' AND iklan_user_id ='.Auth::id();
        $data['iklan'] = Iklan::whereRaw($where)
            ->whereHas('jenis', function($query){
                $query->where('conf_iklan.iklan_type','=',3);
                return $query;
            })
            ->paginate($this->perPage);
        return view('member.iklan.baris', $data);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function add_banner_khusus(Request $request){
        $requestData = $request->all();
        if(!empty($requestData)){
            $this->validate($request, [
                'iklan_category_id' => 'required',
                'iklan_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $iklan = new Iklan;
            $iklan->iklan_iklan_id = $request->iklan_iklan_id;
            $iklan->iklan_user_id = Auth::id();
            $iklan->iklan_title = 'Banner Khusus';
            $iklan->iklan_status = 1;
            $iklan->iklan_category_id = $request->iklan_category_id;
            if($request->is_link == 1){
                $iklan->iklan_link = $request->iklan_link;
            }
            if ($request->hasFile('iklan_image')){
                $file = $request->file('iklan_image');
                $path = public_path('assets/images/iklan');
                $imagename = FunctionLib::doUpload($file, $path);
                $iklan->iklan_image = $imagename;
            }
            $iklan->iklan_note = 'Pembelian iklan banner khusus oleh '.Auth::user()->username.' pada '.date('Y-m-d H:i:s');
            // $iklan->save();
            // dd($iklan);
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        $data['category'] = Category::all();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.iklan.add_banner_khusus', $data);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function banner_khusus(){
        $where = 1;
        $where .= ' AND iklan_user_id ='.Auth::id();
        $data['iklan'] = Iklan::whereRaw($where)
            ->whereHas('jenis', function($query){
                $query->where('conf_iklan.iklan_type','=',3);
                return $query;
            })
            ->paginate($this->perPage);
        return view('member.iklan.banner_khusus', $data);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function add_banner(Request $request){
        $requestData = $request->all();
        if(!empty($requestData)){
            $this->validate($request, [
                'iklan_category_id' => 'required',
                'iklan_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $iklan = new Iklan;
            $iklan->iklan_iklan_id = $request->iklan_iklan_id;
            $iklan->iklan_user_id = Auth::id();
            $iklan->iklan_title = 'Banner';
            $iklan->iklan_status = 1;
            $iklan->iklan_category_id = $request->iklan_category_id;
            if($request->is_link == 1){
                $iklan->iklan_link = $request->iklan_link;
            }
            if ($request->hasFile('iklan_image')){
                $file = $request->file('iklan_image');
                $path = public_path('assets/images/iklan');
                $imagename = FunctionLib::doUpload($file, $path);
                $iklan->iklan_image = $imagename;
            }
            $iklan->iklan_note = 'Pembelian iklan banner oleh '.Auth::user()->username.' pada '.date('Y-m-d H:i:s');
            // $iklan->save();
            // dd($iklan);
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        $data['category'] = Category::all();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.iklan.add_banner', $data);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function banner(){
        $where = 1;
        $where .= ' AND iklan_user_id ='.Auth::id();
        $data['iklan'] = Iklan::whereRaw($where)
            ->whereHas('jenis', function($query){
                $query->where('conf_iklan.iklan_type','=',1);
                return $query;
            })
            ->paginate($this->perPage);
        return view('member.iklan.banner', $data);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function add_slider(Request $request){
        $requestData = $request->all();
        if(!empty($requestData)){
            $this->validate($request, [
                'iklan_category_id' => 'required',
                'iklan_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $iklan = new Iklan;
            $iklan->iklan_iklan_id = $request->iklan_iklan_id;
            $iklan->iklan_user_id = Auth::id();
            $iklan->iklan_title = 'Slider';
            $iklan->iklan_status = 1;
            $iklan->iklan_category_id = $request->iklan_category_id;
            if($request->is_link == 1){
                $iklan->iklan_link = $request->iklan_link;
            }
            if ($request->hasFile('iklan_image')){
                $file = $request->file('iklan_image');
                $path = public_path('assets/images/iklan');
                $imagename = FunctionLib::doUpload($file, $path);
                $iklan->iklan_image = $imagename;
            }
            $iklan->iklan_note = 'Pembelian iklan slider oleh '.Auth::user()->username.' pada '.date('Y-m-d H:i:s');
            // $iklan->save();
            // dd($iklan);
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        $data['category'] = Category::all();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.iklan.add_slider', $data);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function slider(){
        $where = 1;
        $where .= ' AND iklan_user_id ='.Auth::id();
        $data['iklan'] = Iklan::whereRaw($where)
            ->whereHas('jenis', function($query){
                $query->where('conf_iklan.iklan_type','=',2);
                return $query;
            })
            ->paginate($this->perPage);
        return view('member.iklan.slider', $data);
    }

    /**
    * @param method $method
    * @return view
    */
    public function beli_saldo(){
        $data['paket'] = Paket_iklan::all();
        return view('member.iklan.beli_saldo', $data);
    }

    /**
    * @param method $method
    * @return view
    */
    public function to_confirm(Request $request, $id){
        $res = Trans_iklan::findOrFail($id);
        $res->trans_iklan_status = 1;
        $res->save();
        return redirect()->back();
    }

    /**
    * @param method $method
    * @return view
    */
    public function to_cancel(Request $request, $id){
        $res = Trans_iklan::findOrFail($id);
        $res->trans_iklan_status = 2;
        $res->save();
        return redirect()->back();
    }

    /**
    * @param method $method
    * @return 
    */
    public function beli_saldo_store(Request $request){
        $status = 200;
        $message = 'Buy Saldo Iklan Successfully!';
        
        $requestData = $request->all();
        $this->validate($request, [
            'trans_iklan_paket_id' => 'required|numeric',
            'trans_iklan_note' => 'required',
        ]);
        // validasi password
        // $user = User::findOrFail(Auth::id());
        // if (!Hash::check($request->user_detail_pass_trx, $user->user_detail->user_detail_pass_trx)) {
        //     $status = 500;
        //     $message = 'Password does Not Match!';
        //     return redirect()->back()
        //         ->with(['flash_status' => $status,'flash_message' => $message]);
        // }
        // input transaksi
        $paket_iklan = Paket_iklan::whereId($request->trans_iklan_paket_id)->first();
        $code = FunctionLib::str_rand(4).FunctionLib::str_rand(6);
        $date = date('Y-m-d H:i:s');
        $res = new Trans_iklan;
        $res->trans_iklan_code = 'IKL-'.$code;
        $res->trans_iklan_user_id = Auth::id();
        // $res->trans_iklan_status = 0;
        $res->trans_iklan_paket_id = $request->trans_iklan_paket_id;
        $res->trans_iklan_amount = $paket_iklan->paket_iklan_price;
        $res->trans_iklan_note = $request->trans_iklan_note;//'Pembelian Paket Iklan '.$paket_iklan->paket_iklan_name.' by '.Auth::user()->username.' at '
            // .FunctionLib::datetime_indo($date, true, 'full');
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Cannot Buy Saldo Iklan!';
        }

        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function tagihan(Request $request){
        $arr = [
            "0" =>'new',
            "1" =>'wait',
            "3" =>'lunas',
            "2" =>'batal',
            "4" =>'ditolak',
            "0,1,2,3,4" =>'',
        ];
        $where = "1 AND trans_iklan_user_id =".Auth::id();
        if(!empty($request->get('code'))){
            $code = $request->get('code');
            $where .= ' AND trans_iklan_code LIKE "%'.$code.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND trans_iklan_status IN ('.$status.')';
        }
        $data['iklan'] = Trans_iklan::whereRaw($where)->paginate();
        return view('member.iklan.tagihan', $data);
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
            case 'add_baris':
            case 'add_banner':
            case 'add_banner_khusus':
            case 'add_slider':
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
                    </script>
                <?php
                break;
        }
        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
