<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Komplain;
use App\Role;
use App\User;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use FunctionLib;


class KomplainController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_komplain';

    /*******/
    public function done_komplain(Request $request, $id){
        $date = date('Y-m-d H:i:s');
        $status = 200;
        $message = "Komplain selesai, wallet kembali ke member.";
        try{
            $komplain = Komplain::findOrFail($id);
            $komplain->komplain_status = 3;
            $komplain->komplain_clear_date = $date;
            $komplain->save();
                // kembalikan wallet ke member
                if($komplain->trans_detail->trans->trans_payment_id !== 4){
                    $update_wallet = [
                        'user_id'=>$komplain->trans_detail->trans->trans_user_id,
                        'wallet_type'=>3,
                        'amount'=>$komplain->trans_detail->trans->trans_amount_total,
                        'note'=>'Transaksi Success by admin. Update wallet transaksi dikembalikan ke member dengan transaksi kode '.$komplain->trans_detail->trans->trans_code.' dari toko '.$komplain->trans_detail->produk->user->user_store.'.',
                    ];
                    $saldo = FunctionLib::update_wallet($update_wallet);
                    // pengurangan saldo cw saldo admin
                    $update_wallet = [
                        'user_id'=>2,
                        'wallet_type'=>1,
                        'amount'=>($komplain->trans_detail->trans->trans_amount_total * -1),
                        'note'=>'Transaksi Success by admin. Update wallet transaksi dikembalikan ke member dengan transaksi kode '.$komplain->trans_detail->trans->trans_code.' dari toko '.$komplain->trans_detail->produk->user->user_store.'.',
                    ];
                    $saldo = FunctionLib::update_wallet($update_wallet);
                }
                // update transaksi menjadi dropping
                foreach ($komplain->trans_detail->trans->trans_detail as $item) {
                    $item->trans_detail_status = 6;
                    $item->trans_detail_is_cancel = 1;
                    $item->trans_detail_drop = 1;
                    $item->trans_detail_drop_date = $date;
                    $item->trans_detail_drop_note = $item->trans_detail_drop_note.", Komplain sudah selesai dan dana di kembalikan ke member";
                    $item->save();
                }
        } catch (\Exception $e) {
            $status = 500;
            $message = "eksekusi data gagal karena alasan tertentu.";
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function res_kom(Request $request)
    {
        $arr = [
            "1" =>'new',
            "2" =>'help',
            "3" =>'done',
            "1,2,3" =>'',
        ];
        $where = "1";
        if(!empty($request->get('komplain'))){
            $komplain = $request->get('komplain');
            $where .= ' AND conf_komplain.komplain_name LIKE "%'.$komplain.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND sys_komplain.komplain_status IN ('.$status.')';
        }

        if (!empty($where)) {
            $data['komplain'] = Komplain::whereRaw($where)
                ->leftJoin('conf_komplain', 'sys_komplain.komplain_komplain_id', '=', 'conf_komplain.id')
                ->select('sys_komplain.*', 'conf_komplain.komplain_name')
                ->groupBy('sys_komplain.id')
                ->paginate($this->perPage);
        } else {
            $data['komplain'] = Komplain::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.resolusi_komplain.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $arr = [
            "1" =>'new',
            "2" =>'help',
            "3" =>'done',
            "1,2,3" =>'',
        ];
        $where = "1";
        if(!empty($request->get('komplain'))){
            $komplain = $request->get('komplain');
            $where .= ' AND conf_komplain.komplain_name LIKE "%'.$komplain.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND sys_komplain.komplain_status IN ('.$status.')';
        }

        if (!empty($where)) {
            $data['komplain'] = Komplain::whereRaw($where)
                ->leftJoin('conf_komplain', 'sys_komplain.komplain_komplain_id', '=', 'conf_komplain.id')
                ->select('sys_komplain.*', 'conf_komplain.komplain_name')
                ->groupBy('sys_komplain.id')
                ->orderBy('sys_komplain.updated_at', 'DESC')
                ->whereHas('trans_detail', function ($query) {
                    $query->whereHas('produk', function ($query2) {
                        $query2->where('produk_seller_id', '=', Auth::id());
                        return $query2;
                    });
                    return $query;
                })
                ->paginate($this->perPage);
        } else {
            $data['komplain'] = Komplain::whereHas('trans_detail', function ($query) {
                    $query->whereHas('produk', function ($query2) {
                        $query2->where('produk_seller_id', '=', Auth::id());
                        return $query2;
                    });
                    return $query;
                })
                ->paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.resolusi_komplain.detail', $data);
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
        return view('admin.resolusi_komplain.create', $data);
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
            'produk_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $res = new Produk;
        $res->produk_seller_id = Auth::user()->id;
        $res->produk_category_id = $request->produk_category_id;
        $res->produk_brand_id = $request->produk_brand_id;
        $res->produk_name = $request->produk_name;
        $res->produk_slug = str_slug($request->produk_name);
        $res->produk_unit = $request->produk_unit;
        $res->produk_price = $request->produk_price;
        $res->produk_size = $request->produk_size;
        $res->produk_length = $request->produk_length;
        $res->produk_wide = $request->produk_wide;
        $res->produk_color = $request->produk_color;
        $res->produk_stock = $request->produk_stock;
        $res->produk_weight = $request->produk_weight;
        $res->produk_discount = $request->produk_discount;
        $res->produk_image = date("d-M-Y_H-i-s").'_'.$request->produk_image->getClientOriginalName();
        $request->produk_image->move(public_path('assets/images/product'),$res->produk_image);
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
        $data['produk'] = Komplain::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.resolusi_komplain.show', $data);
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
        $data['produk'] = Komplain::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.resolusi_komplain.edit', $data);
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
        $produk = Komplain::findOrFail($id);
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
        $res = Komplain::destroy($id);
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
