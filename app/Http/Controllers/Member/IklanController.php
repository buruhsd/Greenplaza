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
use App\Models\Payment;
use App\Models\Wallet_type;
use App\User;
use Session;
use Auth;
use FunctionLib;

class IklanController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_iklan';

    /**
    * pembayaran pembelian iklan menggunakan saldo
    * @param code
    * @return status / message
    **/
    public function bayar_saldo(Request $request, $code){
        $date = date('Y-m-d H:i:s');
        try{
            $trans = Trans_iklan::whereTrans_iklan_code($code)->first();
            // transfer wallet 
            $wallet_type = Wallet_type::findOrFail($request->wallet_type);
            $update_wallet = [
                'from_id'=>$trans->trans_iklan_user_id,
                'to_id'=>2,
                'wallet_type'=>$request->wallet_type, //1/3
                'amount'=>$trans->trans_iklan_amount,
                'note'=>'Transfer saldo '.$wallet_type->wallet_type_name.' pembelian paket iklan '.$trans->paket->paket_iklan_name.'.',
            ];
            $transfer = FunctionLib::transfer_wallet($update_wallet);
            $check_transfer = ($transfer['status'] == 200)?true:false;
            // $check_transfer = true;

            // // update saldo iklan 
            // if($check_transfer){
            //     $update_wallet = [
            //         'user_id'=>$trans->trans_iklan_user_id,
            //         'wallet_type'=>4,
            //         'amount'=>$trans->trans_iklan_amount,
            //         'note'=>'Update wallet iklan dengan pembelian paket '.$trans->paket->paket_iklan_name.'.',
            //     ];
            //     $saldo = FunctionLib::update_wallet($update_wallet);
            //     $check_saldo = ($saldo['status'] == 200)?true:false;
            //     // $check_saldo = true;
            // }

            if($check_transfer){
                $trans->trans_iklan_status = 1;
                $trans->trans_iklan_paid_date = $date;
                $trans->trans_iklan_note = $trans->trans_iklan_note." Transaksi telah di bayar oleh member.";
                $trans->save();
                $status = 200;
                $message = "Transfer Saldo berhasil.";
            }else{
                $status = 500;
                $message = "transfer gagal, 
                    silahkan ulangi transfer atau check saldo anda. 
                    jika ada masalh dilahkan hubungi admin greenplaza.";
            }
        }catch(\Exception $e){
            $status = 500;
            $message = "transfer gagal, 
                silahkan ulangi transfer atau check saldo anda. 
                jika ada masalh dilahkan hubungi admin greenplaza.";
        }
        if($request->ajax())
        {
            return response()->json(['status'=>$status,'message' => $message]);
        }
        return redirect('member/iklan/tagihan')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * pembayaran pembelian iklan menggunakan GLN
    * @param code
    * @return status / message
    **/
    public function bayar_gln(Request $request, $code){
        $date = date('Y-m-d H:i:s');
        $status = 500;
        $message = "transfer gagal, 
            silahkan ulangi transfer atau check saldo gln anda. 
            jika ada masalh dilahkan hubungi admin greenplaza.";
        try{
            $trans = Trans_iklan::whereTrans_iklan_code($code)->first();
            $from = $trans->user->wallet->where('wallet_type', 7)->first()->wallet_address;
            $to = FunctionLib::get_config('profil_gln_address');
            $amount = $trans->trans_iklan_amount / FunctionLib::gln('compare',[])['data'];
            $amount = round($amount,8, PHP_ROUND_HALF_UP);
            $transfer = FunctionLib::gln('transfer', [
                'to_address' =>$to,
                'amount'=>$amount,
                'address'=>$from
            ]);
            if($transfer['status'] == 200){
                $trans->trans_iklan_status = 1;
                $trans->trans_iklan_paid_date = $date;
                $trans->trans_iklan_note = $trans->trans_iklan_note." Transaksi telah di bayar oleh member.";
                $trans->save();
                $status = 200;
                $message = "Transfer GLN berhasil.";
            }
        }catch(\Exception $e){
            // buat log error
        }
        if($request->ajax())
        {
            return response()->json(['status'=>$status,'message' => $message]);
        }
        return redirect('member/iklan/tagihan')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param $request, $id
    * @return view
    */
    public function generate_qr(Request $request, $id){
        $trans = Trans_iklan::findOrFail($id);
        // $trans->trans_iklan_status = 1;
        // $trans->save();

        $transaction_details = array(
          'note' => $trans->trans_iklan_code,
          'price' => $trans->trans_iklan_amount, // no decimal allowed for creditcard
        );
        try{
            // $masedi = FunctionLib::masedi_payment($transaction_details);
            $masedi = [
                  "status" => true,
                  "va" => "WUN2NLT4HJ"
                ];
            if($masedi['status'] == true){
                $trans->trans_iklan_qr = $masedi['va'];
                $trans->save();
            }
        }catch(\Exception $err){
            
        }
        return redirect()->back();
    }


    /**
     * #buyer
     * process buyer mengkonfirmasi pembayaran
     * @param
     * @return
     */
    public function konfirmasi($id){
        $status = 200;
        $message = 'Anda sudah melakukan transfer!';
        $trans = Trans_iklan::findOrFail($id);
        if($trans->trans_iklan_status == 0){
            $data['trans'] = $trans;
            switch ($trans->trans_iklan_payment_id) {
                case 1:
                    $status = 200;
                    $message = 'Pembayaran menggunakan transfer!';
                break;
                case 2:
                    $status = FunctionLib::midtrans_status($trans->trans_iklan_code);
                    if($status){
                        $trans->trans_iklan_status = 1;
                        $trans->save();
                        $status = 200;
                        $message = 'Anda sudah melakukan transfer!';
                        return redirect()->back()
                            ->with(['flash_status' => $status,'flash_message' => $message]);
                    }else{
                        return view('member.iklan.konfirmasi', $data);
                    }
                break;
                case 3:
                    $message = 'Pembayaran menggunakan Masedi!';
                    return view('member.iklan.konfirmasi.masedi', $data)->with(['flash_status' => $status,'flash_message' => $message]);
                break;
                case 4:
                    $message = 'Pembayaran menggunakan Gln!';
                    return view('member.iklan.konfirmasi.gln', $data)->with(['flash_status' => $status,'flash_message' => $message]);
                break;
                case 5:
                    $message = 'Pembayaran menggunakan Saldo!';
                    return view('member.iklan.konfirmasi.saldo', $data)->with(['flash_status' => $status,'flash_message' => $message]);
                break;                
            }
        }
        return redirect('member/iklan/tagihan')
            ->with(['flash_status' => $status,'flash_message' => $message]);
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
        $data['payment'] = Payment::where('payment_status', 1)->get();
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
        $message = 'Berhasil membeli Saldo Iklan!';
        
        $requestData = $request->all();
        $this->validate($request, [
            'trans_iklan_paket_id' => 'required|numeric',
            'trans_iklan_payment_id' => 'required',
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
        $res->trans_iklan_payment_id = $request->trans_iklan_payment_id;
        $res->trans_iklan_amount = $paket_iklan->paket_iklan_price;
        $res->trans_iklan_note = $request->trans_iklan_note;//'Pembelian Paket Iklan '.$paket_iklan->paket_iklan_name.' by '.Auth::user()->username.' at '
            // .FunctionLib::datetime_indo($date, true, 'full');
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Gagal membeli Saldo Iklan!';
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
        $data['payment'] = Payment::where('payment_status', 1)->get();
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
