<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Trans;
use App\Models\Trans_detail;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use FunctionLib;


class TransactionController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_trans';

    /**
     * #seller status 4
     * process sudah dikirim oleh seller wait dropping
     * @param
     * @return
     */
    public function add_resi(Request $request, $id){
        if ($request->has('trans_detail_no_resi')) {
            // update
            $trans_detail = Trans_detail::findOrFail($id);
            $trans_detail->trans_detail_no_resi = $request->trans_detail_no_resi;
            $trans_detail->trans_detail_send_date = $request->trans_detail_send_date;
            $trans_detail->save();
            return redirect()->back();
        }
        $status = 200;
        $message = 'Transfer approved!';
        $data['trans'] = Trans::findOrFail($id);
        $data['trans_detail'] = $data['trans']->trans_detail->where('trans_detail_status', 5);
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        
        return view('admin.transaction.add_resi', $data);
    }

    /**
     * #seller status 4
     * process sudah dikirim oleh seller wait dropping
     * @param
     * @return
     */
    public function sending(Request $request){
        $requestData = $request->all();
        $status = 200;
        $message = 'Shipment approved!';
        $date = date('y-m-d h:i:s');
        if(!empty($request->detail_id)){            
            foreach ($requestData['detail_id'] as $item) {
                $trans_detail = Trans_detail::findOrFail($item);
                // to shipping true
                if($trans_detail->trans_detail_status == 4){
                    $trans_detail->trans_detail_packing_date = $date;
                    if($request->has('note')){
                        $trans_detail->trans_detail_is_cancel = 1;
                        $trans_detail->trans_detail_status = 4;
                        $trans_detail->trans_detail_packing = 2;
                        $trans_detail->trans_detail_packing_note = "Transaction be Cancel by seller";
                        $trans_detail->trans_detail_note = $request->note;
                        $message = 'Shipment cancelled!';

                        // update saldo transaksi
                        if($trans_detail->trans->trans_payment_id !== 4){
                            $update_wallet = [
                                'user_id'=>$trans_detail->trans->trans_user_id,
                                'wallet_type'=>3,
                                'amount'=>$trans_detail->trans_detail_amount_total,
                                'note'=>'Transaksi cancel by seller '.Auth::id().'. Update wallet transaksi dengan transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                            ];
                            $saldo = FunctionLib::update_wallet($update_wallet);
                        }
                    }else{
                        $trans_detail->trans_detail_status = 5;
                        $trans_detail->trans_detail_packing = 1;
                        $trans_detail->trans_detail_packing_note = "Transaction be packing by seller";
                        $trans_detail->trans_detail_send = 0;
                        $trans_detail->trans_detail_send_date = $date;
                        $trans_detail->trans_detail_send_note = "Transaction be sending by seller";
                    }
                }elseif($trans_detail->trans_detail_status == 5){
                    $trans_detail->trans_detail_status = 5;
                    $trans_detail->trans_detail_send_date = $date;
                    if($request->has('note')){
                        $trans_detail->trans_detail_is_cancel = 1;
                        $trans_detail->trans_detail_send = 2;
                        $trans_detail->trans_detail_send_note = "Transaction be Cancel by seller";
                        $trans_detail->trans_detail_note = $request->note;
                        $message = 'Shipment cancelled!';

                        // update saldo transaksi
                        if($trans_detail->trans->trans_payment_id !== 4){
                            $update_wallet = [
                                'user_id'=>$trans_detail->trans->trans_user_id,
                                'wallet_type'=>3,
                                'amount'=>$trans_detail->trans_detail_amount_total,
                                'note'=>'Transaksi cancel by seller '.Auth::id().'. Update wallet transaksi dengan transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                            ];
                            $saldo = FunctionLib::update_wallet($update_wallet);
                        }
                    }else{
                        $trans_detail->trans_detail_send = 0;
                        $trans_detail->trans_detail_send_note = "Transaction be sending by seller";
                    }
                }
                $trans_detail->save();
            }
        }
        if(!isset($trans_detail) || !$trans_detail){
            $status = 500;
            $message = 'Shipment unapproved!';
        }
        if(empty($request->detail_id)){
            $status = 500;
            $message = 'Shipment unapproved!';
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        if(empty($request->note)){
            return redirect('admin/transaction/add_resi/'.$trans_detail->trans->id)
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * #seller status 4
     * process sudah packing oleh seller pindah ke wait shipping
     * @param
     * @return
     */
    public function packing($id){
        $status = 200;
        $message = 'Transfer approved!';
        $trans = Trans::findOrFail($id);
        foreach ($trans->trans_detail as $item) {
            $trans_detail = Trans_detail::findOrFail($item->id);
            // to shipping false
            $trans_detail->trans_detail_packing = 1;
            $trans_detail->trans_detail_packing_date = date('y-m-d h:i:s');
            $trans_detail->trans_detail_packing_note = "Transaction be packing by seller";
            $trans_detail->trans_detail_send_date = date('y-m-d h:i:s');
            $trans_detail->save();
        }
        if(!$trans_detail){
            $status = 500;
            $message = 'Transfer unapproved!';
        }else{
            // send email
            $send_status = FunctionLib::trans_arr($trans_detail->trans_detail_status);
            $config = [
                'to' => $trans->pembeli->email,
                'data' => [
                    'trans_code' => $trans->trans_code,
                    'trans_amount_total' => $trans->trans_amount_total,
                    'status' => $send_status,
                ]
            ];
            $send_notif = FunctionLib::transaction_notif($config);
            if(isset($send_notif['status']) && $send_notif['status'] == 200){
                $message .= ' ,'.$send_notif['message'];
            }
            $config = [
                'to' => $trans->trans_detail->first()->produk->user->email,
                'data' => [
                    'trans_code' => $trans->trans_code,
                    'trans_amount_total' => $trans->trans_amount_total,
                    'status' => $send_status,
                ]
            ];
            $send_notif = FunctionLib::transaction_notif($config);
            if(isset($send_notif['status']) && $send_notif['status'] == 200){
                $message .= ' ,'.$send_notif['message'];
            }
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * #seller status 3 approve admin
     * process seller menyanggupi pengiriman
     * @param
     * @return
     */
    public function able($id){
        $status = 200;
        $message = 'Transfer approved!';
        $trans = Trans::findOrFail($id);
        foreach ($trans->trans_detail as $item) {
            $trans_detail = Trans_detail::findOrFail($item->id);
            // to packing
            $trans_detail->trans_detail_status = 4;
            $trans_detail->trans_detail_able = 1;
            $trans_detail->trans_detail_able_date = date('y-m-d h:i:s');
            $trans_detail->trans_detail_able_note = "Transaction be able by seller";
            $trans_detail->trans_detail_packing_date = date('y-m-d h:i:s');
            $trans_detail->save();
        }
        if(!$trans_detail){
            $status = 500;
            $message = 'Transfer unapproved!';
        }else{
            // send email
            $send_status = FunctionLib::trans_arr($trans_detail->trans_detail_status);
            $config = [
                'to' => $trans->pembeli->email,
                'data' => [
                    'trans_code' => $trans->trans_code,
                    'trans_amount_total' => $trans->trans_amount_total,
                    'status' => $send_status,
                ]
            ];
            $send_notif = FunctionLib::transaction_notif($config);
            if(isset($send_notif['status']) && $send_notif['status'] == 200){
                $message .= ' ,'.$send_notif['message'];
            }
            $config = [
                'to' => $trans->trans_detail->first()->produk->user->email,
                'data' => [
                    'trans_code' => $trans->trans_code,
                    'trans_amount_total' => $trans->trans_amount_total,
                    'status' => $send_status,
                ]
            ];
            $send_notif = FunctionLib::transaction_notif($config);
            if(isset($send_notif['status']) && $send_notif['status'] == 200){
                $message .= ' ,'.$send_notif['message'];
            }
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * 
     * @param
     * @return
     */
    public function done_masedi(Request $request){
        $status = 200;
        $message = 'Transfer Berhasil';
        // $this->validate($request, [
        //     'order_id' => 'required',
        //     'transaction_status' => 'required',
        // ]);
        $requestData = $request->all();
        $order_id = Trans::whereRaw('trans_qr="'.$requestData['va'].'"')->pluck('trans_code')[0];
        $data = [
            'order_id' => $order_id,
            'transaction_status' => $requestData['transaction_status']
        ];
        $response = FunctionLib::done_masedi($data);
        if($response['status'] == 500){
            $status = $response['status'];
            $message = $response['message'];
        }
        $data = $response['data'];
        return response()->json(['status'=>$status, 'message'=>$message, 'data' => $data]);
        // if($request->ajax()){
        // }
        // return view('admin.transaction.done-order', compact('data'))
        //     ->with(['flash_status' => $status,'flash_message' => $message]);
    }
    
    /**
     * 
     * @param
     * @return
     */
    public function done_order(Request $request){
        $status = 200;
        $message = 'Transfer Berhasil';
        // $this->validate($request, [
        //     'order_id' => 'required',
        //     'transaction_status' => 'required',
        // ]);
        $requestData = $request->all();
        $data = [
            'order_id' => $requestData['order_id'],
            'transaction_status' => $requestData['transaction_status']
        ];
        $response = FunctionLib::done_payment($data);
        if($response['status'] == 500){
            $status = $response['status'];
            $message = $response['message'];
        }
        $data = $response['data'];
        return response()->json(['status'=>$status, 'message'=>$message, 'data' => $data]);
        // if($request->ajax()){
        // }
        // return view('admin.transaction.done-order', compact('data'))
        //     ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * 
     * @param
     * @return
     */
    public function konfirmasi_approve($id){
        $status = 200;
        $message = 'Transfer approved!';
        $trans = Trans::findOrFail($id);
        foreach ($trans->trans_detail as $item) {
            $trans_detail = Trans_detail::findOrFail($item->id);
            $trans_detail->trans_detail_status = 3;
            $trans_detail->trans_detail_transfer = 1;
            $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
            $trans_detail->trans_detail_transfer_note = "Transfer approved by ".Auth::user()->name;
            $trans_detail->trans_detail_able_date = date('y-m-d h:i:s');
            $trans_detail->save();
        }
        if(!$trans_detail){
            $status = 500;
            $message = 'Transfer unapproved!';
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $arr = [
            "0" =>'chart',
            "1" =>'order',
            "2" =>'transfer',
            "3" =>'seller',
            "4" =>'packing',
            "5" =>'shipping',
            "6" =>'dropping',
            "0,1,2,3,4,5,6" =>'',
        ];
        $where = "1";
        $having = "1";
        // $where .= " AND count_detail > 0";
        if(!empty($request->get('code'))){
            $name = $request->get('code');
            $where .= ' AND sys_trans.trans_code LIKE "%'.$name.'%"';
        }
        // if(!empty($request->get('status'))){
        //     $status = $request->get('status');
        //     $status = array_search($status,$arr);
        //     $having .= ' AND trans_detail_status IN ('.$status.')';
        // }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND trans_detail_status IN ('.$status.')';
        }

        if (!empty($where)) {
            $data['transaction'] = Trans::whereRaw($where)
                // ->havingRaw($having)
                ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_trans_id', '=', 'sys_trans.id')
                ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                ->select('sys_trans.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'))
                ->groupBy('sys_trans.id')
                ->paginate($this->perPage);
        } else {
            $data['transaction'] = Trans::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('admin.transaction.index', $data);
    }
    public function paid(Request $request)
    {
        $arr = [
            "0" =>'chart',
            "1" =>'order',
            "2" =>'transfer',
            "3" =>'seller',
            "4" =>'packing',
            "5" =>'shipping',
            "6" =>'dropping',
            "0,1,2,3,4,5,6" =>'',
        ];
        $where = "1";
        $having = "1";
        // $where .= " AND count_detail > 0";
        if(!empty($request->get('code'))){
            $name = $request->get('code');
            $where .= ' AND sys_trans.trans_code LIKE "%'.$name.'%"';
        }
        // if(!empty($request->get('status'))){
        //     $status = $request->get('status');
        //     $status = array_search($status,$arr);
        //     $having .= ' AND trans_detail_status IN ('.$status.')';
        // }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND trans_detail_status IN ('.$status.')';
        }

        if (!empty($where)) {
            $data['transaction'] = Trans::whereRaw($where)
                // ->havingRaw($having)
                ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_trans_id', '=', 'sys_trans.id')
                ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                ->select('sys_trans.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'))
                ->groupBy('sys_trans.id')
                ->where('trans_is_paid', 1)
                ->paginate($this->perPage);
        } else {
            $data['transaction'] = Trans::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('admin.transaction.paid', $data);
    }
    public function notyet(Request $request)
    {
        $arr = [
            "0" =>'chart',
            "1" =>'order',
            "2" =>'transfer',
            "3" =>'seller',
            "4" =>'packing',
            "5" =>'shipping',
            "6" =>'dropping',
            "0,1,2,3,4,5,6" =>'',
        ];
        $where = "1";
        $having = "1";
        // $where .= " AND count_detail > 0";
        if(!empty($request->get('code'))){
            $name = $request->get('code');
            $where .= ' AND sys_trans.trans_code LIKE "%'.$name.'%"';
        }
        // if(!empty($request->get('status'))){
        //     $status = $request->get('status');
        //     $status = array_search($status,$arr);
        //     $having .= ' AND trans_detail_status IN ('.$status.')';
        // }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND trans_detail_status IN ('.$status.')';
        }

        if (!empty($where)) {
            $data['transaction'] = Trans::whereRaw($where)
                // ->havingRaw($having)
                ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_trans_id', '=', 'sys_trans.id')
                ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                ->select('sys_trans.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'))
                ->groupBy('sys_trans.id')
                ->where('trans_is_paid', 0)
                ->paginate($this->perPage);
        } else {
            $data['transaction'] = Trans::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('admin.transaction.notyet', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.transaction.create', $data);
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
        
        $this->validate($request, [
            'trans_name' => 'required',
            'trans_slug' => 'required',
            'trans_unit' => 'required',
            'trans_price' => 'required',
            'trans_size' => 'required',
            'trans_length' => 'required',
            'trans_wide' => 'required',
            'trans_color' => 'required',
            'trans_stock' => 'required',
            'trans_weight' => 'required',
            'trans_discount' => 'required',
            'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $res = new Produk;
        $res->trans_seller_id = Auth::user()->id;
        $res->trans_category_id = $request->trans_category_id;
        $res->trans_brand_id = $request->trans_brand_id;
        $res->trans_name = $request->trans_name;
        $res->trans_slug = $request->trans_slug;
        $res->trans_unit = $request->trans_unit;
        $res->trans_price = $request->trans_price;
        $res->trans_size = $request->trans_size;
        $res->trans_length = $request->trans_length;
        $res->trans_wide = $request->trans_wide;
        $res->trans_color = $request->trans_color;
        $res->trans_stock = $request->trans_stock;
        $res->trans_weight = $request->trans_weight;
        $res->trans_discount = $request->trans_discount;
        $res->trans_image = date("d-M-Y_H-i-s").'_'.$request->trans_image->getClientOriginalName();
        $request->trans_image->move(public_path('assets/images/product'),$res->trans_image);
        $res->trans_note = $request->trans_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Produk Not added!';
        }
        return redirect('admin/transaction')
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
        $data['produk'] = Trans::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.transaction.show', $data);
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
        $data['transaction'] = Trans::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.transaction.edit', $data);
    }
    public function edit_trans ($id)
    {
        return view('admin.transaction.edit_trans');
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
            'trans_seller_id' => 'required',
            'trans_name' => 'required',
            'trans_slug' => 'required',
            'trans_unit' => 'required',
            'trans_price' => 'required',
            'trans_size' => 'required',
            'trans_length' => 'required',
            'trans_wide' => 'required',
            'trans_color' => 'required',
            'trans_stock' => 'required',
            'trans_weight' => 'required',
            'trans_discount' => 'required',
            'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $produk = Trans::findOrFail($id);
        $produk->trans_seller_id = $request->trans_seller_id;
        $produk->trans_category_id = $request->trans_category_id;
        $produk->trans_brand_id = $request->trans_brand_id;
        $produk->trans_name = $request->trans_name;
        $produk->trans_slug = $request->trans_slug;
        $produk->trans_unit = $request->trans_unit;
        $produk->trans_price = $request->trans_price;
        $produk->trans_size = $request->trans_size;
        $produk->trans_length = $request->trans_length;
        $produk->trans_wide = $request->trans_wide;
        $produk->trans_color = $request->trans_color;
        $produk->trans_stock = $request->trans_stock;
        $produk->trans_weight = $request->trans_weight;
        $produk->trans_discount = $request->trans_discount;
        $produk->trans_image = date("d-M-Y_H-i-s").'_'.$request->trans_image->getClientOriginalName();
        $request->trans_image->move(public_path('assets/images/product'),$produk->trans_image);
        $produk->trans_note = $request->trans_note;
        $produk->save();
        $res = $produk->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Produk Not updated!';
        }

        return redirect('admin/transaction')
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
        $res = Trans::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Produk Not deleted!';
        }

        return redirect('admin/transaction')
            ->with(['flash_status' => $status,'flash_message' => $message]);
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
