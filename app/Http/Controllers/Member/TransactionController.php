<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Payment;
use App\Models\Trans;
use App\Models\Trans_detail;
use App\Models\Trans_gln;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;
use FunctionLib;
use RajaOngkir;

class TransactionController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_trans';

    /******/
    public function done_gln($order_id){
        $status = 200;
        $message = 'Transaksi berhasil dibayar.';
        $data = [
            'order_id' => $order_id,
            'transaction_status' => 'done'
        ];
        $address_gln = Auth::user()->wallet()->where('wallet_type', 7)->first()->wallet_address;
        $response = FunctionLib::gln('ballance', ['address'=>$address_gln]);
        if($response['status'] == 500){
            $status = 500;
            $message = 'Transaksi gagal dibayar atau saldo gln anda tidak mencukupi, silahkan cek saldo.';
            return redirect('member.transaction.purchase')
               ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        $trans = Trans::whereRaw('trans_code="'.$order_id.'"')->get();
        $to_address = FunctionLib::get_config('profil_gln_address');
        
        $amount_total = 0;
        $amount = 0;
        $fee = 0;
        $no = 0;
        print_r(1);
        if(!Trans::whereRaw('trans_code="'.$order_id.'"')->first()->trans_gln()->exists()){            
            foreach ($trans as $item) {
                foreach ($item->trans_detail as $item2) {
                    // rupiah
                    $detail_amount = $item2->trans_detail_amount;
                    $detail_amount_ship = $item2->trans_detail_amount_ship;
                    $detail_fee = ($detail_amount*(FunctionLib::get_config('price_pajak_admin_gln'))/100);
                    // gln
                    $detail_amount = $detail_amount / FunctionLib::gln('compare',[])['data'];
                    $detail_amount = round($detail_amount,8, PHP_ROUND_HALF_DOWN);
                    $detail_amount_ship = $detail_amount_ship / FunctionLib::gln('compare',[])['data'];
                    $detail_amount_ship = round($detail_amount_ship,8, PHP_ROUND_HALF_DOWN);
                    $detail_fee = $detail_fee / FunctionLib::gln('compare',[])['data'];
                    $detail_fee = (round($detail_fee,8, PHP_ROUND_HALF_DOWN) + 0.00000001);
                    $detail_amount_total = $detail_amount+$detail_fee+$detail_amount_ship;
                    // untuk insert
                    $wallet_to = ($item2->produk->user->wallet()->where('wallet_type', 7)->exists())
                        ?$item2->produk->user->wallet()->where('wallet_type', 7)->first()->wallet_address
                        :$item2->produk->user->id;
                    $detail[$no]['trans_gln_form']=$address_gln;
                    $detail[$no]['trans_gln_admin']=$to_address;
                    $detail[$no]['trans_gln_to']=$wallet_to;
                    $detail[$no]['trans_gln_trans_id']=$item2->trans->id;
                    $detail[$no]['trans_gln_trans_code']=$item2->trans->trans_code;
                    $detail[$no]['trans_gln_detail_id']=$item2->id;
                    $detail[$no]['trans_gln_detail_code']=$item2->trans_code;
                    $detail[$no]['trans_gln_amount']=$detail_amount+$detail_amount_ship;
                    $detail[$no]['trans_gln_amount_fee']=$detail_fee;
                    $detail[$no]['trans_gln_amount_total']=$detail_amount_total;
                    $detail[$no]['trans_gln_note']='transfer gln untuk transaksi produk sebesar '.$detail_amount_total.' GLN dari member ke admin termasuk fee.';
                    $amount_total = $amount_total + $detail_amount_total;
                    $no++;
                    print_r(2);
                }
            }
            foreach ($detail as $item) {
                $gln = new Trans_gln;
                $gln->trans_gln_form=$item['trans_gln_form'];
                $gln->trans_gln_admin=$item['trans_gln_admin'];
                $gln->trans_gln_to=$item['trans_gln_to'];
                $gln->trans_gln_trans_id=$item['trans_gln_trans_id'];
                $gln->trans_gln_trans_code=$item['trans_gln_trans_code'];
                $gln->trans_gln_detail_id=$item['trans_gln_detail_id'];
                $gln->trans_gln_detail_code=$item['trans_gln_detail_code'];
                $gln->trans_gln_amount=$item['trans_gln_amount'];
                $gln->trans_gln_amount_fee=$item['trans_gln_amount_fee'];
                $gln->trans_gln_amount_total=$item['trans_gln_amount_total'];
                $gln->trans_gln_note=$item['trans_gln_note'];
                $gln->save();
                print_r(3);
            }
        }else{
            foreach ($trans as $item) {
                $amount_total = $amount_total + FunctionLib::array_sum_key($item->trans_gln()->get()->toArray(), 'trans_gln_amount_total');
                print_r(4);
            }
        }
        $transfer = FunctionLib::gln('transfer', ['to_address' =>$to_address,'amount'=>$amount_total,'address'=>$address_gln]);
        print_r(5);
        if($transfer['status'] == 500){
            $status = 500;
            $message = 'transfer gagal atau saldo gln anda tidak mencukupi, silahkan cek saldo.';
            return redirect('member.transaction.purchase')
               ->with(['flash_status' => $status,'flash_message' => $message]);
            print_r(6);
        }
        foreach ($trans as $item) {
            $gln = $item->trans_gln()->get();
            foreach ($gln as $item) {
                $item->trans_gln_status=1;
                $item->save();
            }
            print_r(7);
        }

        $response = FunctionLib::done_gln($data);
        if($response['status'] == 500){
            $status = $response['status'];
            $message = $response['message'];
            print_r(8);
        }
        print_r(9);
        return redirect('member.transaction.purchase')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * #member
     * process brang diambil oleh buyer
     * @param
     * @return
     */
    public function dropping($id){
        $status = 200;
        $message = 'Barang Sudah sampai dan diterima!';
        $trans = Trans::findOrFail($id);
        foreach ($trans->trans_detail as $item) {
            $trans_detail = Trans_detail::findOrFail($item->id);
            // to dropping
            $trans_detail->trans_detail_status = 6;
            $trans_detail->trans_detail_drop = 1;
            $trans_detail->trans_detail_drop_date = date('y-m-d h:i:s');
            $trans_detail->trans_detail_drop_note = "Transaction be dropping by buyer";
            $trans_detail->save();

            // update saldo transaksi
            $detail_amount = $trans_detail->trans_detail_amount;
            $detail_amount_ship = $trans_detail->trans_detail_amount_ship;
            $detail_fee = ($detail_amount*(FunctionLib::get_config('price_pajak_admin'))/100);

            $detail_amount = round($detail_amount,8, PHP_ROUND_HALF_DOWN);
            $detail_amount_ship = round($detail_amount_ship,8, PHP_ROUND_HALF_DOWN);
            $detail_fee = round($detail_fee,8, PHP_ROUND_HALF_UP);
            $detail_amount_total = $detail_amount-$detail_fee+$detail_amount_ship;
            if($trans_detail->trans->trans_payment_id !== 4){
                $update_wallet = [
                    'user_id'=>$trans_detail->produk->produk_seller_id,
                    'wallet_type'=>3,
                    'amount'=>$detail_amount_total,
                    'note'=>'Update wallet transaksi dengan transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                ];
                $saldo = FunctionLib::update_wallet($update_wallet, 'transaction');
            }
        }
        if(!$trans_detail){
            $status = 500;
            $message = 'Barang Belum sampai!';
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
            $email_status = FunctionLib::trans_arr($trans_detail->trans_detail_status);
            $config = [
                'to' => $trans->pembeli->email,
                'data' => [
                    'trans_code' => $trans->trans_code,
                    'trans_amount_total' => $trans->trans_amount_total,
                    'status' => $email_status,
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
     * #buyer
     * process buyer mengkonfirmasi pembayaran
     * @param
     * @return
     */
    public function konfirmasi_all($id){
        $status = 200;
        $message = 'Transfer confirmed!';
        $trans = Trans::findOrFail($id);
        $m_status = FunctionLib::midtrans_status($trans->trans_code);
        if($m_status){
            $in = 'select id from sys_trans where trans_code = "'.$trans->trans_code.'"';
            $detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
            foreach ($detail as $item) {
                $trans_detail = Trans_detail::findOrFail($item->id);
                // to transfer
                $trans_detail->trans_detail_status = 2;
                $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                $trans_detail->save();
            }
            if(!$trans_detail){
                $status = 500;
                $message = 'Transfer unconfirmed!';
            }else{
                // send email
                $status = FunctionLib::trans_arr($trans_detail->trans_detail_status);
                $config = [
                    'to' => $trans->pembeli->email,
                    'data' => [
                        'trans_code' => $trans->trans_code,
                        'trans_amount_total' => $trans->trans_amount_total,
                        'status' => $status,
                    ]
                ];
                $send_notif = FunctionLib::transaction_notif($config);
                if(isset($send_notif['status']) && $send_notif['status'] == 200){
                    $message .= ' ,'.$send_notif['message'];
                }
            }
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }else{
            $data['trans'] = Trans::where('trans_code', $trans->trans_code)->get();
            return view('member.transaction.konfirmasi_all', $data)->with(['flash_status' => $status,'flash_message' => $message]);
        }
    }

    /**
     * #buyer status 2
     * process buyer mengkonfirmasi pembayaran
     * @param
     * @return
     */
    public function konfirmasi($id){
        $status = 200;
        $message = 'Transaksi sudah dibayar!';
        $trans = Trans::findOrFail($id);
        $m_status = FunctionLib::midtrans_status($trans->trans_code);
        if($m_status){
            $in = 'select id from sys_trans where trans_code = "'.$trans->trans_code.'"';
            $detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
            foreach ($detail as $item) {
                $trans_detail = Trans_detail::findOrFail($item->id);
                // to transfer
                $trans_detail->trans_detail_status = 2;
                $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                $trans_detail->save();
            }
            $message = 'Transaksi sudah dikonfirmasi!, silahkan lakukan pembayaran.';
            if(!$trans_detail){
                $status = 500;
                $message = 'Transaksi belum dibayar!';
            }else{
                // send email
                $status = FunctionLib::trans_arr($trans_detail->trans_detail_status);
                $config = [
                    'to' => $trans->pembeli->email,
                    'data' => [
                        'trans_code' => $trans->trans_code,
                        'trans_amount_total' => $trans->trans_amount_total,
                        'status' => $status,
                    ]
                ];
                $send_notif = FunctionLib::transaction_notif($config);
                if(isset($send_notif['status']) && $send_notif['status'] == 200){
                    $message .= ' ,'.$send_notif['message'];
                }
            }
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }else{
            $trans = Trans::where('trans_code', $trans->trans_code)->first();
            if($trans->trans_is_paid !== 1){
                $data['trans'] = Trans::where('trans_code', $trans->trans_code)->get();
                return view('member.transaction.konfirmasi', $data)->with(['flash_status' => $status,'flash_message' => $message]);
            }
            return redirect('member.transaction.purchase')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
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
                $where .= ' AND sys_trans_detail.trans_detail_is_cancel != 1';
                $where .= ' AND trans_detail_status IN ('.$status.')';
                $where .= ' AND sys_komplain.id IS NULL';
            }
        }
        if(!empty($request->get('payment'))){
            $payment = $request->get('payment');
            $where .= ' AND conf_payment.payment_kode LIKE "%'.$payment.'%"';
        }

        if (!empty($where)) {
            $data['transaction'] = Trans::whereRaw($where)
                // ->havingRaw($having)
                ->leftJoin('conf_payment', 'sys_trans.trans_payment_id', '=', 'conf_payment.id')
                ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_trans_id', '=', 'sys_trans.id')
                ->leftJoin('sys_komplain', 'sys_trans_detail.id', '=', 'sys_komplain.komplain_trans_id')
                ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                ->select('sys_trans.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'))
                ->groupBy('sys_trans.id')
                ->paginate($this->perPage);
        } else {
            $data['transaction'] = Trans::paginate($this->perPage);
        }
        $data['payment'] = Payment::where('payment_status', 1)->get();
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
        // $req = [
        //     'data' => [
        //         'waybill' => "17120066412",
        //         'courier' => 'pos',
        //     ]
        // ];

        // $shipment = RajaOngkir::waybill($req);
        // $shipment = json_decode($shipment, true);
        // dd($shipment);
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
        // $where = "1 
        //     AND trans_detail_is_cancel != 1
        //     AND trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".Auth::id().")";
        $where = "1 
            AND trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".Auth::id().")";
        $having = "1";
        // $where .= " AND count_detail > 0";
        if(!empty($request->get('code'))){
            $name = $request->get('code');
            $where .= ' AND sys_trans.trans_code LIKE "%'.$name.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            // update
            if($status == 'cancel'){
                $where .= ' AND sys_trans_detail.trans_detail_is_cancel = 1';
                $where .= ' AND sys_komplain.id IS NULL';
            }elseif($status == 'komplain'){
                $where .= ' AND sys_trans_detail.trans_detail_is_cancel = 1';
                $where .= ' AND sys_komplain.id IS NOT NULL';
            }
            // sampai sini
            elseif($request->has('type')){
                $arr = [
                    "3" =>'wait',
                    "4" =>'approve'
                ];
                $status = array_search($request->get('type'),$arr);
                $where .= ' AND sys_trans_detail.trans_detail_is_cancel != 1';
                $where .= ' AND trans_detail_status IN ('.$status.')';
            }else{
                $status = array_search($request->get('status'),$arr);
                $where .= ' AND sys_trans_detail.trans_detail_is_cancel != 1';
                $where .= ' AND trans_detail_status IN ('.$status.')';
            }
        }
        if(!empty($request->get('payment'))){
            $payment = $request->get('payment');
            $where .= ' AND conf_payment.payment_kode LIKE "%'.$payment.'%"';
        }

        if (!empty($where)) {
            $data['transaction'] = Trans::whereRaw($where)
                // ->havingRaw($having)
                ->leftJoin('conf_payment', 'sys_trans.trans_payment_id', '=', 'conf_payment.id')
                ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_trans_id', '=', 'sys_trans.id')
                ->leftJoin('sys_komplain', 'sys_trans_detail.id', '=', 'sys_komplain.komplain_trans_id')
                ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                ->select('sys_trans.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'))
                ->groupBy('sys_trans.id')
                ->paginate($this->perPage);
        } else {
            $data['transaction'] = Trans::paginate($this->perPage);
        }
        $data['payment'] = Payment::where('payment_status', 1)->get();
        // dd($data['transaction']);
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
