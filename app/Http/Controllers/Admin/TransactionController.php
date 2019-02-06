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
        if($request->ajax()){
            return response()->json(['message'=>$message, 'status'=>$status, 'data' => $data]);
        }
        return view('admin.transaction.done-order', compact('data'))
            ->with(['flash_status' => $status,'flash_message' => $message]);
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
        if($request->ajax()){
            return response()->json(['message'=>$message, 'status'=>$status, 'data' => $data]);
        }
        return view('admin.transaction.done-order', compact('data'))
            ->with(['flash_status' => $status,'flash_message' => $message]);
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
