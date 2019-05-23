<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Payment;
use App\Models\Trans;
use App\Models\Produk;
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
use App\Models\Review;

class TransactionController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_trans';

    /******/
    public function done_saldo(Request $request, $order_id){
        $date = date('Y-m-d H:i:s');
        $status = 200;
        $message = 'Transfer Berhasil';
        $requestData = $request->all();

        try{
            $trans = Trans::whereRaw('trans_code="'.$order_id.'"');
            $sum_trans = Trans::whereRaw('trans_code="'.$order_id.'"')->sum('trans_amount_total');
            $sum_wallet = $sum_trans;
            $sum_transfer = $sum_trans;

            // check saldo dan validasi
            if($trans->first()->voucher()){
                $model_voucher = $trans->first()->voucher();
                $sum_wallet = FunctionLib::minus_to_zero($sum_trans - $model_voucher->trans_voucher_amount);
            }
            $wallet = Auth::user()->wallet->where('wallet_type', $request->wallet_type)->first();
            $wallet_type = $wallet->type;
            if($wallet->wallet_ballance < $sum_wallet){
                $status = 500;
                $message = 'Maaf saldo anda tidak mencukupi untuk melakukan pembayaran, silahkan cek saldo '.$wallet_type->wallet_type_name.' anda.';
                if($request->ajax())
                {
                    return response()->json(['status'=>$status,'message' => $message]);
                }
                return redirect('member/transaction/purchase')
                    ->with(['flash_status' => $status,'flash_message' => $message]);
            }

            $note_wallet = 'Transfer saldo '.$wallet->wallet_type_name.' untuk transaksi '.$trans->first()->trans_code;
            if($trans->first()->voucher()){
                if($model_voucher->trans_voucher_amount > $sum_trans){
                    $sum_transfer = $model_voucher->trans_voucher_amount;
                }
                $note_wallet .= ', dan voucher masedi '.$model_voucher->trans_voucher_code.'.';
            }

            // update wallet buyer
            $update_wallet = [
                'user_id'=>$trans->first()->pembeli->id,
                'wallet_type'=>$request->wallet_type,
                'amount'=>($sum_wallet * -1),
                'note'=>$note_wallet,
            ];
            $from_buyer = FunctionLib::update_wallet($update_wallet);
            // update wallet admin
            $update_wallet = [
                'user_id'=>2,
                'wallet_type'=>1,
                'amount'=>$sum_transfer,
                'note'=>$note_wallet,
            ];
            $to_admin = FunctionLib::update_wallet($update_wallet);
            $check_transfer = ($to_admin['status'] == 200)?true:false;

            if($check_transfer){
                // update status transaksi
                $in = 'select id from sys_trans where trans_code = "'.$order_id.'"';
                $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
                if($trans_detail && !empty($trans_detail) && $trans_detail !== null && count($trans_detail) > 0){
                    $trans_one = Trans::whereRaw('trans_code="'.$order_id.'"')->first();
                    if($trans_one->trans_is_paid == 1){
                        $status = 500;
                        $message = 'Transaksi sudah dibayar.';
                        $response['data'][] = "";
                        return $response;
                    }
                    $trans = Trans::whereRaw('trans_code="'.$order_id.'"')->get();
                    foreach ($trans as $item) {
                        $item->trans_is_paid = 1;
                        $item->trans_paid_date = $date;
                        $item->trans_paid_note = 'pembayaran dengan Saldo selesai.';
                        $item->trans_note = 'pembayaran dengan Saldo telah selesai.';
                        $item->save();
                    }
                    foreach ($trans_detail as $item) {
                        $trans_detail = Trans_detail::findOrFail($item->id);
                        // to transfer
                        $trans_detail->trans_detail_status = 3;
                        $trans_detail->trans_detail_transfer = 1;
                        $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                        $trans_detail->trans_detail_note = $trans_detail->trans_detail_note.' Transfer Berhasil.';
                        $trans_detail->save();
                        // $response['data'][] = $trans_detail;
                    }
                    // send email to buyer
                    $email_status = FunctionLib::trans_arr($trans_detail->trans_detail_status);
                    $config = [
                        'to' => $trans_one->pembeli->email,
                        'data' => [
                            'trans_code' => $trans_one->trans_code,
                            'trans_amount_total' => $trans_one->trans_amount_total,
                            'status' => $email_status,
                        ]
                    ];
                    $send_notif = FunctionLib::transaction_notif($config);
                    if(isset($send_notif['status']) && $send_notif['status'] == 200){
                        $message .= ' ,'.$send_notif['message'];
                    }
                    // send email seller
                    foreach ($trans as $item) {
                        $config = [
                            'to' => $item->trans_detail->first()->produk->user->email,
                            'data' => [
                                'trans_code' => $item->trans_code,
                                'trans_amount_total' => $item->trans_amount_total,
                                'status' => $email_status,
                            ]
                        ];
                        $send_notif = FunctionLib::transaction_notif($config);
                        if(isset($send_notif['status']) && $send_notif['status'] == 200){
                            $message .= ' ,'.$send_notif['message'];
                        }
                    }
                    if($trans->first()->voucher()){
                        $model_voucher = $trans->first()->voucher();
                        $voucher = [
                            'voucher' => $model_voucher->trans_voucher_code
                        ];
                        $res_voucher = FunctionLib::masedi('use', $voucher);
                        if($res_voucher['status'] == 200){
                            $model_voucher->trans_voucher_status = 1;
                            $model_voucher->save();
                        }
                    }
                }
            }else{
                $status = 500;
                $message = 'transfer gagal atau saldo anda tidak mencukupi, silahkan cek saldo anda.';
            }
        }catch(Exception $e){
            $status = 500;
            $message = 'transfer gagal atau saldo anda tidak mencukupi, silahkan cek saldo anda.';
        }

        if($request->ajax())
        {
            return response()->json(['status'=>$status,'message' => $message]);
        }
        return redirect('member/transaction/purchase')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    public function review_produk(Request $request, $id){
        $status = 200;
        $message = 'Review produk berhasil disimpan';
        $trans = Trans::findOrFail($id);
        foreach ($trans->trans_detail as $item) {
            $res = new Review;
            $res->review_produk_id = $item->trans_detail_produk_id;
            $res->review_user_id = $request->review_user_id;
            $res->review_stars = $request->review_stars;
            $res->review_text = $request->review_text;
            $res->save();
        }
        $trans->trans_is_review = 1;
        $trans->save();
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }
    /******/
    public function done_gln($order_id){
        $status = 200;
        $message = 'Transaksi berhasil dibayar.';
        $data = [
            'order_id' => $order_id,
            'transaction_status' => 'done'
        ];
        $trans = Trans::whereRaw('trans_code="'.$order_id.'"');
        $address_gln = Auth::user()->wallet()->where('wallet_type', 7)->first()->wallet_address;
        $response = FunctionLib::gln('ballance', ['address'=>$address_gln]);
        if($response['status'] == 500){
            $status = 500;
            $message = 'Transaksi gagal dibayar atau saldo gln anda tidak mencukupi, silahkan cek saldo.';
            return redirect('member/transaction/purchase')
               ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        $to_address = FunctionLib::get_config('profil_gln_address');
        $seller_address = ($trans->first()->trans_detail->first()->produk->user->wallet()->where('wallet_type', 7)->exists())
            ?$trans->first()->trans_detail->first()->produk->user->wallet()->where('wallet_type', 7)->exists()
            :false;

        if(!$seller_address || $seller_address == null || $seller_address == ""){
            $status = 500;
            $message = 'Seller tidak melayani pembayaran menggunakan GLN.';
            return redirect('member/transaction/purchase')
               ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        
        $amount_total = 0;
        $amount = 0;
        $fee = 0;
        if(!$trans->first()->trans_gln()->exists()){
            if($trans->first()->voucher()){
                $transaksi = $trans->first();
                // rupiah
                $trans_amount = $transaksi->trans_amount;
                $trans_amount_ship = $transaksi->trans_amount_ship;
                $trans_amount_total = FunctionLib::minus_to_zero($transaksi->trans_amount_total - $trans->first()->voucher()->trans_voucher_amount);
                if($trans_amount_total > 0){
                    $trans_fee = (FunctionLib::minus_to_zero($trans_amount - $trans->first()->voucher()->trans_voucher_amount)*(FunctionLib::get_config('price_pajak_admin_gln'))/100);
                }else{
                    $trans_fee = 0;
                }
                // gln
                $trans_amount = $trans_amount_total / FunctionLib::gln('compare',[])['data'];
                $trans_amount = round($trans_amount,8, PHP_ROUND_HALF_DOWN);
                $trans_fee = $trans_fee / FunctionLib::gln('compare',[])['data'];
                $trans_fee = round($trans_fee,8, PHP_ROUND_HALF_UP);
                $trans_amount_total = $trans_amount+$trans_fee;
                // untuk insert
                $wallet_to = ($transaksi->trans_detail->first()->produk->user->wallet()->where('wallet_type', 7)->exists())
                    ?$transaksi->trans_detail->first()->produk->user->wallet()->where('wallet_type', 7)->first()->wallet_address
                    :$transaksi->trans_detail->first()->produk->user->id;

                // simpan trans gln 
                $gln = new Trans_gln;
                $gln->trans_gln_form=$address_gln;
                $gln->trans_gln_admin=$to_address;
                $gln->trans_gln_to=$wallet_to;
                $gln->trans_gln_trans_id=$transaksi->id;
                $gln->trans_gln_trans_code=$transaksi->trans_code;
                $gln->trans_gln_detail_id=0;
                $gln->trans_gln_detail_code=0;
                $gln->trans_gln_amount=$trans_amount;
                $gln->trans_gln_amount_fee=$trans_fee;
                $gln->trans_gln_amount_total=$trans_amount_total;
                $gln->trans_gln_compare=FunctionLib::gln('compare',[])['data'];
                $gln->trans_gln_note='transfer gln untuk transaksi produk (voucher+gln) sebesar '.$trans_amount_total.' GLN dari member ke admin termasuk fee.';
                $gln->save();

                $amount_total = $amount_total + $trans_amount_total;
            }else{
                foreach ($trans->get() as $item) {
                    foreach ($item->trans_detail as $item2) {
                        // rupiah
                        $detail_amount = $item2->trans_detail_amount;
                        $detail_amount_ship = $item2->trans_detail_amount_ship;
                        $detail_fee = ($detail_amount*(FunctionLib::get_config('price_pajak_admin_gln'))/100);
                        // gln
                        $detail_amount = ($detail_amount + $detail_amount_ship) / FunctionLib::gln('compare',[])['data'];
                        $detail_amount = round($detail_amount,8, PHP_ROUND_HALF_DOWN);
                        // $detail_amount_ship = $detail_amount_ship / FunctionLib::gln('compare',[])['data'];
                        // $detail_amount_ship = round($detail_amount_ship,8, PHP_ROUND_HALF_DOWN);
                        $detail_fee = $detail_fee / FunctionLib::gln('compare',[])['data'];
                        $detail_fee = round($detail_fee,8, PHP_ROUND_HALF_UP);
                        // $detail_amount_total = $detail_amount+$detail_fee+$detail_amount_ship;
                        $detail_amount_total = $detail_amount+$detail_fee;
                        // untuk insert
                        $wallet_to = ($item2->produk->user->wallet()->where('wallet_type', 7)->exists())
                            ?$item2->produk->user->wallet()->where('wallet_type', 7)->first()->wallet_address
                            :$item2->produk->user->id;

                        // simpan trans gln 
                        $gln = new Trans_gln;
                        $gln->trans_gln_form=$address_gln;
                        $gln->trans_gln_admin=$to_address;
                        $gln->trans_gln_to=$wallet_to;
                        $gln->trans_gln_trans_id=$item2->trans->id;
                        $gln->trans_gln_trans_code=$item2->trans->trans_code;
                        $gln->trans_gln_detail_id=$item2->id;
                        $gln->trans_gln_detail_code=$item2->trans_code;
                        // $gln->trans_gln_amount=$detail_amount+$detail_amount_ship;
                        $gln->trans_gln_amount=$detail_amount;
                        $gln->trans_gln_amount_fee=$detail_fee;
                        $gln->trans_gln_amount_total=$detail_amount_total;
                        $gln->trans_gln_compare=FunctionLib::gln('compare',[])['data'];
                        $gln->trans_gln_note='transfer gln untuk transaksi produk sebesar '.$detail_amount_total.' GLN dari member ke admin termasuk fee.';
                        $gln->save();

                        $amount_total = $amount_total + $detail_amount_total;
                    }
                }
            }
        }else{
            foreach ($trans->get() as $item) {
                $amount_total = $amount_total + FunctionLib::array_sum_key($item->trans_gln()->get()->toArray(), 'trans_gln_amount_total');
            }
        }
        if($trans->first()->voucher()){
            if($amount_total > 0){
                $transfer = FunctionLib::gln('transfer', ['to_address' =>$to_address,'amount'=>$amount_total,'address'=>$address_gln]);
            }else{
                $transfer['status'] = 200;
            }
            if($transfer['status'] == 200){
                // update wallet admin
                $update_wallet = [
                    'user_id'=>2,
                    'wallet_type'=>1, //update wallet cw
                    'amount'=>$trans->first()->voucher()->trans_voucher_amount,
                    'note'=>'Transaksi transfer '.Auth::id().'. Update wallet cw dengan kode transaksi '.$trans->first()->trans_code.'.',
                ];
                $saldo = FunctionLib::update_wallet($update_wallet);
            }
        }else{
            $transfer = FunctionLib::gln('transfer', ['to_address' =>$to_address,'amount'=>$amount_total,'address'=>$address_gln]);
        }
        if($transfer['status'] == 200){
            foreach ($trans->get() as $item) {
                $gln = $item->trans_gln()->get();
                foreach ($gln as $item) {
                    $item->trans_gln_status=1;
                    $item->save();
                }
            }

            $response = FunctionLib::done_gln($data);
            if($response['status'] == 500){
                $status = $response['status'];
                $message = $response['message'];
            }
        }else{
            $status = 500;
            $message = 'transfer gagal atau saldo gln anda tidak mencukupi, silahkan cek saldo.';
        }
        return redirect('member/transaction/purchase')
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
                    'from_id'=>2,
                    'to_id'=>$trans_detail->produk->produk_seller_id,
                    'wallet_type'=>1, //1/3
                    'amount'=>$detail_amount_total,
                    'note'=>'Update wallet CW dengan transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                ];
                $saldo = FunctionLib::transfer_wallet($update_wallet);
                // $update_wallet = [
                //     'user_id'=>$trans_detail->produk->produk_seller_id,
                //     'wallet_type'=>1,
                //     'amount'=>$detail_amount_total,
                //     'note'=>'Update wallet CW dengan transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                // ];
                // $saldo = FunctionLib::update_wallet($update_wallet);

                // memberikan bonus kepada sponsor
                $sponsor = FunctionLib::get_sponsor($trans_detail->produk->produk_seller_id);
                $update_wallet = [
                    'from_id'=>$trans_detail->produk->produk_seller_id,
                    'to_id'=>$sponsor,
                    'wallet_type'=>1, //1/3
                    'amount'=>($detail_amount*(FunctionLib::get_config('price_percen_refferal'))/100),
                    'note'=>'memberikan bonus refferal kepada user sponsor dari transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                ];
                $saldo = FunctionLib::transfer_wallet($update_wallet);
            }
        }
        if(!$trans_detail){
            $status = 500;
            $message = 'Barang Belum sampai!';
        }else{
            // send email
            $send_status = FunctionLib::trans_arr($trans_detail->trans_detail_status);
            // if ($trans->trans_payment_id == 1){
            //     $trans2 = 'Transfer';
            // }elseif ($trans->trans_payment_id == 2){
            //     $trans2 = 'Midtrans';
            // }elseif ($trans->trans_payment_id == 3){
            //     $trans2 = 'Masedi';
            // }elseif ($trans->trans_payment_id == 4){
            //     $trans2 = 'Greenline';
            // }
            $trans2 = $trans->payment->payment_name;
            $config = [
                'to' => $trans->pembeli->email,
                'data' => [
                    'trans_code' => $trans->trans_code,
                    'trans_amount_total' => $trans->trans_amount_total,
                    'status' => $send_status,
                    'payment' => $trans2,
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
        $message = 'Tambah nomor resi berhasil!';
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
        $message = 'barang siap dikirim!';
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
                            $update_wallet = [
                                'user_id'=>2,
                                'wallet_type'=>1,
                                'amount'=>($trans_detail->trans_detail_amount_total * -1),
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
                            $update_wallet = [
                                'user_id'=>2,
                                'wallet_type'=>1,
                                'amount'=>($trans_detail->trans_detail_amount_total * -1),
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
        if(!$request->has('note')){
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
        $message = 'Packing Selesai!';
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
            $message = 'Gagal merubah data!';
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

    /********/
    public function able_cancel($id){
        $date = date('Y-m-d H:i:s');
        $status = 200;
        $message = 'transaksi telah di cancel!';
        $trans = Trans::findOrFail($id);
        foreach ($trans->trans_detail as $item) {
            // to packing
            $item->trans_detail_is_cancel = 1;
            $item->trans_detail_status = 3;
            $item->trans_detail_able = 2;
            $item->trans_detail_able_date = $date;
            $item->trans_detail_able_note = 'Transaksi dibatalkan oleh seller.';
            $item->trans_detail_note = 'Transaksi Dibatalkan oleh seller.';
            $item->save();
            
            $item->produk->produk_stock = $item->produk->produk_stock + $item->trans_detail_qty;
            // dd($item->produk->produk_stock);
            $item->produk->save();

        }
        if(!$item){
            $status = 500;
            $message = 'Gagal merubah data!';
        }else{
            if($trans->trans_payment_id !== 4){
                $update_wallet = [
                    'user_id'=>$trans->pembeli->id,
                    'wallet_type'=>3,
                    'amount'=>$trans->trans_amount_total,
                    'note'=>'pengembalian wallet transaksi dengan transaksi kode '.$trans->trans_code.'.',
                ];
                $saldo = FunctionLib::update_wallet($update_wallet);
                $update_wallet = [
                    'user_id'=>2,
                    'wallet_type'=>1,
                    'amount'=>($trans->trans_amount_total * -1),
                    'note'=>'pengembalian wallet transaksi dengan transaksi kode '.$trans->trans_code.'.',
                ];
                $saldo = FunctionLib::update_wallet($update_wallet);
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
        $message = 'anda telah menyanggupi transaksi!';
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
            $message = 'Gagal merubah data!';
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
            return redirect('member/transaction/purchase')
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
                ->paginate(10);
        } else {
            $data['transaction'] = Trans::paginate(10);
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
                ->paginate(10);
        } else {
            $data['transaction'] = Trans::paginate(10);
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

    public function note_seller(Request $request, $code){
        $status = 200;
        $message = 'Pesan sudah terkirim';
        $trans = Trans::where('trans_code',$code)->get();
        foreach ($trans as $t) {
            $t->trans_seller_note = $request->note_seller;
            $t->save();
        }
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
    }
}
