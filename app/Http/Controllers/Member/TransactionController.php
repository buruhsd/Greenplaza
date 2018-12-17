<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Trans;
use App\Models\Trans_detail;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;
use FunctionLib;


class TransactionController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_trans';

    /**
     * #member
     * process brang diambil oleh buyer
     * @param
     * @return
     */
    public function dropping($id){
        $status = 200;
        $message = 'Transfer approved!';
        $trans = Trans::findOrFail($id);
        foreach ($trans->trans_detail as $item) {
            $trans_detail = Trans_detail::findOrFail($item->id);
            // to dropping
            $trans_detail->trans_detail_status = 6;
            $trans_detail->trans_detail_drop = 1;
            $trans_detail->trans_detail_drop_date = date('y-m-d h:i:s');
            $trans_detail->trans_detail_drop_note = "Transaction be dropping by buyer";
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
        
        return view('member.transaction.add_resi', $data);
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
                    if(!empty($request->note)){
                        $trans_detail->trans_detail_is_cancel = 1;
                        $trans_detail->trans_detail_status = 4;
                        $trans_detail->trans_detail_packing = 2;
                        $trans_detail->trans_detail_packing_note = "Transaction be Cancel by seller";
                        $trans_detail->trans_detail_note = $request->note;
                        $message = 'Shipment cancelled!';
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
                    if(!empty($request->note)){
                        $trans_detail->trans_detail_is_cancel = 1;
                        $trans_detail->trans_detail_send = 2;
                        $trans_detail->trans_detail_send_note = "Transaction be Cancel by seller";
                        $trans_detail->trans_detail_note = $request->note;
                        $message = 'Shipment cancelled!';
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
            return redirect('member/transaction/add_resi/'.$trans_detail->trans->id)
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
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * #buyer
     * process buyer mengkonfirmasi pembayaran
     * @param
     * @return
     */
    public function konfirmasi($id){
        $status = 200;
        $message = 'Transfer confirmed!';
        $trans = Trans::findOrFail($id);
        // $status = FunctionLib::midtrans_status($trans->trans_code);
        // if($status){
            foreach ($trans->trans_detail as $item) {
                $trans_detail = Trans_detail::findOrFail($item->id);
                // to transfer
                $trans_detail->trans_detail_status = 2;
                $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                $trans_detail->save();
            }
            if(!$trans_detail){
                $status = 500;
                $message = 'Transfer unconfirmed!';
            }
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        // }else{
        //     $data['trans'] = Trans::where('trans_code', $trans->trans_code)->first();
        //     return view('member.transaction.konfirmasi', $data);
        // }
    }

    /**
     * #buyer
     * @param
     * @return
     */
    public function purchase(Request $request)
    {
        $arr = [
            "0" =>'chart',
            "1" =>'order',
            "2" =>'transfer',
            "3" =>'seller',
            "4" =>'packing',
            "5" =>'shipping',
            "5,5" =>'sent',
            "6" =>'dropping',
            "0,1,2,3,4,5,6" =>'',
        ];
        $where = "1 AND trans_user_id=".Auth::id();
        $having = "1";
        // $where .= " AND count_detail > 0";
        if(!empty($request->get('code'))){
            $name = $request->get('code');
            $where .= ' AND sys_trans.trans_code LIKE "%'.$name.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            if($status == 'cancel'){
                $where .= ' AND sys_trans_detail.trans_detail_is_cancel = 1';
                $where .= ' AND sys_komplain.id IS NULL';
            }elseif($status == 'komplain'){
                $where .= ' AND sys_trans_detail.trans_detail_is_cancel = 1';
                $where .= ' AND sys_komplain.id IS NOT NULL';
            }else{
                $status = array_search($status,$arr);
                $where .= ' AND trans_detail_status IN ('.$status.')';
            }
        }

        if (!empty($where)) {
            $data['transaction'] = Trans::whereRaw($where)
                // ->havingRaw($having)
                ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_trans_id', '=', 'sys_trans.id')
                ->leftJoin('sys_komplain', 'sys_trans_detail.id', '=', 'sys_komplain.komplain_trans_id')
                ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                ->select('sys_trans.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'))
                ->groupBy('sys_trans.id')
                ->paginate($this->perPage);
        } else {
            $data['transaction'] = Trans::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('member.transaction.purchase', $data);
    }

    /**
     * #seller
     * @param
     * @return
     */
    public function sales(Request $request)
    {
        $arr = [
            "0" =>'chart',
            "1" =>'order',
            "2" =>'transfer',
            "3,4" =>'packing',
            "5" =>'shipping',
            "5,5" =>'sent',
            "6" =>'dropping',
            "0,1,2,3,4,5,6" =>'',
        ];
        $where = "1 
            AND trans_detail_is_cancel != 1
            AND trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".Auth::id().")";
        $having = "1";
        // $where .= " AND count_detail > 0";
        if(!empty($request->get('code'))){
            $name = $request->get('code');
            $where .= ' AND sys_trans.trans_code LIKE "%'.$name.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            if($request->has('type')){
                $arr = [
                    "3" =>'wait',
                    "4" =>'approve'
                ];
                $status = array_search($request->get('type'),$arr);
                $where .= ' AND trans_detail_status IN ('.$status.')';
            }else{
                $status = array_search($request->get('status'),$arr);
                $where .= ' AND trans_detail_status IN ('.$status.')';
            }
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

        return view('member.transaction.index', $data);
    }

    /**
     * 
     * @param
     * @return
     */
    public function create()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.transaction.create', $data);
    }

    /**
     * 
     * @param
     * @return
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
        return redirect('member/transaction')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * 
     * @param
     * @return
     */
    public function show($id)
    {
        $data['produk'] = Trans::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.transaction.show', $data);
    }

    /**
     * 
     * @param
     * @return
     */
    public function edit($id)
    {
        $data['produk'] = Trans::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.transaction.edit', $data);
    }

    /**
     * 
     * @param
     * @return
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

        return redirect('member/transaction')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * 
     * @param
     * @return
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

        return redirect('member/transaction')
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
            case 'add_resi':
                ?>
                    <link href="<?php echo asset('admin/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css') ?>" rel="stylesheet">
                    <script src="<?php echo asset('admin/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js') ?>"></script>
                    <script type="text/javascript">
                        $('.datepicker').datetimepicker();
                    </script>
                <?php
                break;
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
