<?php
class FunctionLib
{

    public static function sum_wd($id, $type=""){
        $total = 0;
        if($type !== ""){
            $total = 0;
        }else{
            $where = "withdrawal_user_id =".$id;
            $where .= " AND withdrawal_status =1";
            $qry = App\Models\Withdrawal::whereRaw($where)->select(DB::raw("SUM(withdrawal_wallet_amount) as total"))->first();
            $total = $qry->total;
        }
        return $total;
    }

    /**
    * create wallet user #user wallet yang belum tersedia
    * @param
    * @return
    **/
    public static function create_wallet_user($id = 0){
        $data['status'] = 500;
        $data['message'] = "Tidak ada Wallet user yang dibuat oleh system.";
        $data['total'] = 0;
        if($id == 'admin'){
            $user = App\User::findOrFail(2);
            $data['status'] = 200;
            $data['message'] = "Wallet user telah dibuat oleh system.";
            $wallet_type = App\Models\Wallet_type::all();
            foreach ($wallet_type as $wallet) {
                if(!$user->wallet()->whereRaw('wallet_type='.$wallet->id)->exists()){
                    $log = [
                        'wallet_user_id' => 2,
                        'wallet_type' => $wallet->id, 
                        'wallet_ballance_before' => 0,
                        'wallet_ballance' => 0,
                        // 'wallet_address' => $item->wallet_address,
                        // 'wallet_public' => $item->wallet_public,
                        // 'wallet_private' => $item->wallet_private,
                        'wallet_note' => "Created by system."
                    ];
                    if($wallet->id == 7){
                        $log['wallet_address'] = FunctionLib::get_config('profil_gln_address');
                    }
                    App\Models\Wallet::create($log);
                    $data['total'] = $data['total'] + 1;
                }
            }
        }elseif($id !== 0){
            $user = App\User::findOrFail($id);
            $data['status'] = 200;
            $data['message'] = "Wallet user telah dibuat oleh system.";
            $wallet_type = App\Models\Wallet_type::where('id', '!=', 7)->get();
            foreach ($wallet_type as $wallet) {
                if(!$user->wallet()->whereRaw('wallet_type='.$wallet->id)->exists()){
                    $log = [
                        'wallet_user_id' => $id,
                        'wallet_type' => $wallet->id, 
                        'wallet_ballance_before' => 0,
                        'wallet_ballance' => 0,
                        // 'wallet_address' => $item->wallet_address,
                        // 'wallet_public' => $item->wallet_public,
                        // 'wallet_private' => $item->wallet_private,
                        'wallet_note' => "Created by system."
                    ];
                    App\Models\Wallet::create($log);
                    $data['total'] = $data['total'] + 1;
                }
            }
        }
        return $data;
    }

    public static function user_notif($id, $limit=10, $type=""){
        $where = '1';
        $where .= ($type == "")
            ?' AND read_at IS NULL'
            :' AND read_at IS NOT NULL';
        $read_order = ($type == "")
            ?'ASC'
            :'DESC';
        $orderBy = 'read_at '.$read_order.', updated_at DESC';
        $data = App\User::findOrFail($id)->notifikasi()->whereRaw($where)->limit($limit)->orderByRaw($orderBy);
        return $data;
    }

    /*******/
    public static function sum_cart_diskon($arr){
        $sum = array_sum(array_map(
            function($item) {
                $diskon = App\Models\Produk::select('produk_discount')->findOrFail($item['trans_detail_produk_id']);
                $amount = ($item['trans_detail_amount'] * $diskon['produk_discount'] / 100);
                return $amount;
            }, $arr)
        );
        return $sum;
    }

    /*******/
    public static function sum_cart_price($arr, $key){
        $sum = array_sum(array_map(
            function($item) {
                return $item[$key];
            }, $arr)
        );
    }

    /**/
    public static function add_cron($param=[]){
        extract($param);
        $log = new App\Models\Log_cron_job;
        $log->cron_job_method = $cron_job_method;
        $log->cron_job_type = $cron_job_type;
        $log->cron_job_status = $cron_job_status;
        $log->cron_job_title = $cron_job_title;
        $log->cron_job_note = $cron_job_note;
        $log->save();
    }
    /**
    * @param $data [order_id, transaction_status]
    * @return
    **/
    public static function done_gln($data=[]){
        if(!empty($data)){
            $response['status'] = 200;
            $response['message'] = 'Transfer Berhasil!';
        }else{
            $response['status'] = 500;
            $response['message'] = 'Transfer Gagal!';
            return $response;
        }
        $date = date('Y-m-d H:i:s');
        extract($data);
        switch ($transaction_status) {
            case 'done':
                $in = 'select id from sys_trans where trans_code = "'.$order_id.'"';
                $trans_detail = App\Models\Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
                if($trans_detail && !empty($trans_detail) && $trans_detail !== null && count($trans_detail) > 0){
                    $trans_one = App\Models\Trans::whereRaw('trans_code="'.$order_id.'"')->first();
                    if($trans_one->trans_is_paid == 1){
                        $response['status'] = 500;
                        $response['message'] = 'Transaksi sudah dibayar.';
                        $response['data'][] = "";
                        return $response;
                    }
                    $trans = App\Models\Trans::whereRaw('trans_code="'.$order_id.'"')->get();
                    foreach ($trans as $item) {
                        $item->trans_is_paid = 1;
                        $item->trans_paid_date = $date;
                        $item->trans_paid_note = 'pembayaran dengan Gln selesai.';
                        $item->trans_note = 'pembayaran dengan Gln telah selesai.';
                        $item->save();
                    }
                    foreach ($trans_detail as $item) {
                        $trans_detail = App\Models\Trans_detail::findOrFail($item->id);
                        // to transfer
                        $trans_detail->trans_detail_status = 3;
                        $trans_detail->trans_detail_transfer = 1;
                        $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                        $trans_detail->trans_detail_note = $trans_detail->trans_detail_note.' Transfer Successfully.';
                        $trans_detail->save();
                        $response['data'][] = $trans_detail;
                    }
                    // send email
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
                        $response['message'] .= ' ,'.$send_notif['message'];
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
                            $response['message'] .= ' ,'.$send_notif['message'];
                        }
                    }
                }else{
                    $type = ((str_contains(strtolower($order_id), 'hl-'))?'hotlist'
                        :((str_contains(strtolower($order_id), 'ikl-'))?'iklan'
                        :((str_contains(strtolower($order_id), 'pc-'))?'pincode':'')));
                    switch ($type) {
                        case 'hotlist':
                            $trans_detail = App\Models\Trans_hotlist::whereRaw('trans_hotlist_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_hotlist_status = 3;
                            $trans_detail->trans_hotlist_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_hotlist_response_note = 'Transfer Successfully. approved by system.';
                            $trans_detail->trans_hotlist_note = $trans_detail->trans_hotlist_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $update_wallet = [
                                    'user_id'=>$trans_detail->trans_hotlist_user_id,
                                    'wallet_type'=>6,
                                    'amount'=>$trans_detail->paket->paket_hotlist_amount + $trans_detail->paket->paket_hotlist_bonus,
                                    'note'=>'Update wallet hotlist dengan pembelian paket '.$trans_detail->paket->paket_hotlist_name.'.',
                                ];
                                $saldo = FunctionLib::update_wallet($update_wallet);
                            $response['data'][] = $trans_detail;
                        break;
                        case 'pincode':
                            $trans_detail = App\Models\Trans_pincode::whereRaw('trans_pincode_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_pincode_status = 3;
                            $trans_detail->trans_pincode_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_pincode_response_note = 'Transfer Successfully. approved by system.';
                            $trans_detail->trans_pincode_note = $trans_detail->trans_detail_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $update_wallet = [
                                    'user_id'=>$trans_detail->trans_hotlist_user_id,
                                    'wallet_type'=>5,
                                    'amount'=>($trans_detail->paket->paket_pincode_amount + $trans_detail->paket->paket_pincode_bonus),
                                    'note'=>'Update wallet pincode dengan pembelian paket '.$trans_detail->paket->paket_pincode_name.'.',
                                ];
                                $saldo = FunctionLib::update_wallet($update_wallet);
                            $response['data'][] = $trans_detail;
                        break;
                        case 'iklan':
                            $trans_detail = App\Models\Trans_iklan::whereRaw('trans_iklan_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_iklan_status = 3;
                            $trans_detail->trans_iklan_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_iklan_response_note = ' Transfer Successfully. approved by system.';
                            $trans_detail->trans_iklan_note = $trans_detail->trans_iklan_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $update_wallet = [
                                    'user_id'=>$trans_detail->trans_hotlist_user_id,
                                    'wallet_type'=>4,
                                    'amount'=>($trans_detail->paket->paket_iklan_amount + $trans_detail->paket->paket_iklan_bonus),
                                    'note'=>'Update wallet iklan dengan pembelian paket '.$trans_detail->paket->paket_iklan_name.'.',
                                ];
                                $saldo = FunctionLib::update_wallet($update_wallet);
                            $response['data'][] = $trans_detail;
                        break;
                        default:
                            $response['status'] = 500;
                            $response['message'] = 'Transfer Gagal!';
                            $response['data'][] = "";
                        break;
                    }
                }
                return $response;
            break;
            default:
                $response['status'] = 500;
                $response['message'] = 'Transfer Gagal!';
                return $response;
            break;
        }
    }

    /**
    * untuk api gln
    * @param $type(method fungsi), $param(relative)
    * @return status,message,data
    */
    public static function gln($type, $param=[]){
        $status = 500;
        $message = 'Server tidak merespon.';
        extract($param);
        switch ($type) {
            case 'create':
                $response = Gln::create(['data'=>['label'=>$label]]);
                $response = json_decode($response, true);
                if(isset($response['success']) && $response['success'] == true){
                    $status = 200;
                    $message = 'Wallet berhasil dibuat';
                }
                // {"success":true,"data":{"label":"coba","address":"49uM7bUnHkkFBroa9L4iI3RpDuaQkNUcH","private":"4f5a7fd80a6455911f0bb108e7dbf96fa31c385a1b3bf6608df9080f931c82c10db6b3f089db3b6d8e01ac2b45c86c7d45f9aaac716461c8504b1920f2a8cabb","public":"121607ceaf31e67274eda92fbc1976a077d42a05529b4d1d22ed8d48227816a4341bbb9a3b57a4a02d8c28f419188815ca713503817b543188ab745605eaed2a"}}
            break;
            case 'transfer':
                $response = Gln::transfer(['data'=>['to_address' =>$to_address,'amount'=>$amount],'address'=>$address]);
                $response = json_decode($response, true);
                if(isset($response['success']) && $response['success'] == true){
                    // insert log transfer gln
                    $log_transfer = new App\Models\Log_transfer;
                        $from = App\Models\Wallet::where('wallet_address', $address)->first();
                        $log_transfer->transfer_user_id = $from->wallet_user_id;
                        $log_transfer->transfer_from = $response['data']['block']['sender'];
                        $to = App\Models\Wallet::where('wallet_address', $to_address)->first();
                        $log_transfer->transfer_to_user_id = $to->wallet_user_id;
                        $log_transfer->transfer_to = $response['data']['block']['receiver'];
                        $log_transfer->transfer_code_reff = $response['data']['block']['txid'];
                        $log_transfer->transfer_type = 'gln';
                        $log_transfer->transfer_nominal = $response['data']['block']['value'];
                        $log_transfer->transfer_response = json_encode($response);
                        $log_transfer->transfer_note = "transfer Gln";
                    $log_transfer->save();

                    $status = 200;
                    $message = 'Wallet berhasil dibuat';
                }
                // "{"success":false,"data":{"message":"failed ! please check your password and addres wallet"}}"
            break;
            case 'ballance':
                $response = Gln::ballance(['address'=>$address]);
                $response = json_decode($response, true);
                if(isset($response['success']) && $response['success'] == true){
                    $status = 200;
                    $message = 'Wallet berhasil dibuat';
                }
            break;
            case 'list':
                $response = Gln::list([]);
                $response = json_decode($response, true);
                if(isset($response['success']) && $response['success'] == true){
                    $status = 200;
                    $message = 'Wallet berhasil dibuat';
                }
                // "{"success":true,"data":[{"id":1579,"user_id":218,"label":"coba","address":"49uM7bUnHkkFBroa9L4iI3RpDuaQkNUcH","private":"4f5a7fd80a6455911f0bb108e7dbf96fa31c385a1b3bf6608df9080f931c82c10db6b3f089db3b6d8e01ac2b45c86c7d45f9aaac716461c8504b1920f2a8cabb","public":"121607ceaf31e67274eda92fbc1976a077d42a05529b4d1d22ed8d48227816a4341bbb9a3b57a4a02d8c28f419188815ca713503817b543188ab745605eaed2a","password":"eyJpdiI6IkhCenRTSkhhQVMyM2FjTXB4S0FvV1E9PSIsInZhbHVlIjoiMUVGVFE3Y2VieUxOUkt1bzVJQnJlZz09IiwibWFjIjoiZWZmYmJjODRlM2MzZDJiNzY3MmNmY2Y0M2IwY2FhMDg3MTg1MDRiYWI3NTMxZGM3NDU2NWMzNWYyNTdmYmE4NiJ9","created_at":"2019-02-11 17:06:58","updated_at":"2019-02-11 17:06:58"}]}
            break;
            case 'compare':
                $response = Gln::compare([]);
                $response = json_decode($response, true);
                if(isset($response['price'])){
                    $status = 200;
                    $message = 'berhasil mendapat compare gln to rupiah.';
                    $return = ['status'=>$status, 'message'=>$message, 'data'=>$response['price']];
                    return $return;
                }
                // "{"price":35685}"
            break;
            default:
                $status = 500;
                $message = 'Server tidak merespon.';
            break;
        }

        $data = (isset($response['data']))?$response['data']:[];
        $return = ['status'=>$status, 'message'=>$message, 'data'=>$data];
        return $return;
    }

    /**
    * @param date1, date2
    * @return
    **/
    public static function daysBetween($date1, $date2, $type='d') {
        $diff = date_diff(
            date_create($date2),  
            date_create($date1)
        );
        switch ($type) {
            case 'd':
                $selisih = $diff->$type;
            break;
            case 'h':
                $selisih = $diff->h + ($diff->days*24);
            break;
        }
        return $selisih;
    }

    /**
    * @param user_id, wallet_type, amount, note
    * @return
    **/
    public static function update_wallet($param=[], $type='non'){
        $date = date('Y-m-d H:i:s');
        $status = 200;
        $message = 'Wallet berhasi diubah.';
        extract($param);
        // update saldo hotlist
        $where = 'wallet_user_id='.$user_id;
        $where .= ' AND wallet_type='.$wallet_type;
        switch ($type) {
            case 'non':
                $saldo = App\Models\Wallet::whereRaw($where)->first();
                $saldo->wallet_ballance_before = $saldo->wallet_ballance;
                $saldo->wallet_ballance = $saldo->wallet_ballance + $amount;
                $saldo->wallet_note = $note;
                $saldo->save();
            break;
            case 'transaction':
                $amount = $amount-($amount*(FunctionLib::get_config('price_pajak_admin'))/100);
                $saldo = App\Models\Wallet::whereRaw($where)->first();
                $saldo->wallet_ballance_before = $saldo->wallet_ballance;
                $saldo->wallet_ballance = $saldo->wallet_ballance + $amount;
                $saldo->wallet_note = $note;
                $saldo->save();
            break;
        }

        $return = ['status'=>$status, 'message'=>$message];
        return $return;
    }

    /**
    * @param
    * @return
    **/
    public static function masedi_payment($data = []){
        $req = [
            'data' => [
                'username' => 'greenplaza',
                'password' => 1,
                'note' => $data['note'],
                'price' => $data['price'],
            ]
        ];
        $payment = MasEdi::payment($req);
        $payment = json_decode($payment, true);
        return $payment;
    }

    public static function trans_arr($key){
        $arr = [
            0 => 'Chart',
            1 => 'Order',
            2 => 'Transfer',
            3 => 'Menunggu Seller',
            4 => 'Pengepakan',
            5 => 'Dikirim',
            6 => 'Diambil',
            7 => 'Komplain',
            8 => 'Cancel',
            9 => 'Order Cancel',
            10 => 'Seller Cancel',
        ];
        return $arr[$key];
    } 

    /******/
    public static function transaction_notif($param=[]){
        $data['status'] = 200;
        $data['message'] = 'Notifikasi telah dikirim';
        extract($param);
        // send email
        $config = [
            'to' => $to,
            'subject' => 'Status Transaksi',
            'view' => 'email.transaction',
            'data' => $data
        ];
        SendEmail::html($config);
        return $data;
    }

    /*******/
    public static function get_hotlist($id){
        $produk = App\Models\Produk::whereId($id)->first();
        return $produk->produk_hotlist;
    }

    /**
    * create wallet user #user wallet yang belum tersedia
    * @param
    * @return
    **/
    public static function create_wallet(){
        $data['status'] = 200;
        $data['message'] = "Wallet user telah dibuat oleh system.";
        $data['total'] = 0;
        $user = App\User::orderBy('id')->get();
        foreach ($user as $item) {
            $wallet_type = App\Models\Wallet_type::where('id', '!=', 7)->get();
            foreach ($wallet_type as $wallet) {
                if(!$item->wallet()->whereRaw('wallet_type='.$wallet->id)->exists()){
                    $log = [
                        'wallet_user_id' => $item->id,
                        'wallet_type' => $wallet->id, 
                        'wallet_ballance_before' => 0,
                        'wallet_ballance' => 0,
                        // 'wallet_address' => $item->wallet_address,
                        // 'wallet_public' => $item->wallet_public,
                        // 'wallet_private' => $item->wallet_private,
                        'wallet_note' => "Created by system."
                    ];
                    App\Models\Wallet::create($log);
                    $data['total'] = $data['total'] + 1;
                }
            }
        }
        return $data;
    }

    /**
    * @param $data [order_id, transaction_status]
    * @return
    **/
    public static function done_masedi($data=[]){
        if(!empty($data)){
            $response['status'] = 200;
            $response['message'] = 'Transfer Berhasil!';
        }else{
            $response['status'] = 500;
            $response['message'] = 'Transfer Gagal!';
            return $response;
        }
        $date = date('Y-m-d H:i:s');
        extract($data);
        switch ($transaction_status) {
            case 'done':
                $in = 'select id from sys_trans where trans_code = "'.$order_id.'"';
                $trans_detail = App\Models\Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
                if($trans_detail && !empty($trans_detail) && $trans_detail !== null && count($trans_detail) > 0){
                    $trans_one = App\Models\Trans::whereRaw('trans_code="'.$order_id.'"')->first();
                    if($trans_one->trans_is_paid == 1){
                        $response['status'] = 500;
                        $response['message'] = 'Transaksi sudah dibayar.';
                        $response['data'][] = "";
                        return $response;
                    }
                    $trans = App\Models\Trans::whereRaw('trans_code="'.$order_id.'"')->get();
                    foreach ($trans as $item) {
                        $item->trans_is_paid = 1;
                        $item->trans_paid_date = $date;
                        $item->trans_paid_note = 'pembayaran dengan Masedi selesai.';
                        $item->trans_note = 'pembayaran dengan Masedi telah selesai.';
                        $item->save();
                    }
                    foreach ($trans_detail as $item) {
                        $trans_detail = App\Models\Trans_detail::findOrFail($item->id);
                        // to transfer
                        $trans_detail->trans_detail_status = 3;
                        $trans_detail->trans_detail_transfer = 1;
                        $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                        $trans_detail->trans_detail_note = $trans_detail->trans_detail_note.' Transfer Successfully.';
                        $trans_detail->save();
                        $response['data'][] = $trans_detail;
                    }
                    // send email
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
                        $response['message'] .= ' ,'.$send_notif['message'];
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
                            $response['message'] .= ' ,'.$send_notif['message'];
                        }
                    }
                }else{
                    $type = ((str_contains(strtolower($order_id), 'hl-'))?'hotlist'
                        :((str_contains(strtolower($order_id), 'ikl-'))?'iklan'
                        :((str_contains(strtolower($order_id), 'pc-'))?'pincode':'')));
                    switch ($type) {
                        case 'hotlist':
                            $trans_detail = App\Models\Trans_hotlist::whereRaw('trans_hotlist_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_hotlist_status = 3;
                            $trans_detail->trans_hotlist_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_hotlist_response_note = 'Transfer Successfully. approved by system.';
                            $trans_detail->trans_hotlist_note = $trans_detail->trans_hotlist_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $update_wallet = [
                                    'user_id'=>$trans_detail->trans_hotlist_user_id,
                                    'wallet_type'=>6,
                                    'amount'=>$trans_detail->paket->paket_hotlist_amount + $trans_detail->paket->paket_hotlist_bonus,
                                    'note'=>'Update wallet hotlist dengan pembelian paket '.$trans_detail->paket->paket_hotlist_name.'.',
                                ];
                                $saldo = FunctionLib::update_wallet($update_wallet);
                            $response['data'][] = $trans_detail;
                        break;
                        case 'pincode':
                            $trans_detail = App\Models\Trans_pincode::whereRaw('trans_pincode_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_pincode_status = 3;
                            $trans_detail->trans_pincode_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_pincode_response_note = 'Transfer Successfully. approved by system.';
                            $trans_detail->trans_pincode_note = $trans_detail->trans_detail_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $update_wallet = [
                                    'user_id'=>$trans_detail->trans_hotlist_user_id,
                                    'wallet_type'=>5,
                                    'amount'=>($trans_detail->paket->paket_pincode_amount + $trans_detail->paket->paket_pincode_bonus),
                                    'note'=>'Update wallet pincode dengan pembelian paket '.$trans_detail->paket->paket_pincode_name.'.',
                                ];
                                $saldo = FunctionLib::update_wallet($update_wallet);
                            $response['data'][] = $trans_detail;
                        break;
                        case 'iklan':
                            $trans_detail = App\Models\Trans_iklan::whereRaw('trans_iklan_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_iklan_status = 3;
                            $trans_detail->trans_iklan_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_iklan_response_note = ' Transfer Successfully. approved by system.';
                            $trans_detail->trans_iklan_note = $trans_detail->trans_iklan_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $update_wallet = [
                                    'user_id'=>$trans_detail->trans_hotlist_user_id,
                                    'wallet_type'=>4,
                                    'amount'=>($trans_detail->paket->paket_iklan_amount + $trans_detail->paket->paket_iklan_bonus),
                                    'note'=>'Update wallet iklan dengan pembelian paket '.$trans_detail->paket->paket_iklan_name.'.',
                                ];
                                $saldo = FunctionLib::update_wallet($update_wallet);
                            $response['data'][] = $trans_detail;
                        break;
                        default:
                            $response['status'] = 500;
                            $response['message'] = 'Transfer Gagal!';
                            $response['data'][] = "";
                        break;
                    }
                }
                return $response;
            break;
            default:
                $response['status'] = 500;
                $response['message'] = 'Transfer Gagal!';
                return $response;
            break;
        }
    }

    /**
    * @param $data [order_id, transaction_status]
    * @return
    **/
    public static function done_payment($data=[]){
        if(!empty($data)){
            $response['status'] = 200;
            $response['message'] = 'Transfer Berhasil!';
        }else{
            $response['status'] = 500;
            $response['message'] = 'Transfer Gagal!';
            return $response;
        }
        $date = date('Y-m-d H:i:s');
        extract($data);
        switch ($transaction_status) {
            case 'settlement':
                $in = 'select id from sys_trans where trans_code = "'.$order_id.'"';
                $trans_detail = App\Models\Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
                if($trans_detail && !empty($trans_detail) && $trans_detail !== null && count($trans_detail) > 0){
                    // update sys_trans
                    $trans_one = App\Models\Trans::whereRaw('trans_code="'.$order_id.'"')->first();
                    if($trans_one->trans_is_paid == 1){
                        $response['status'] = 500;
                        $response['message'] = 'Transaksi sudah dibayar.';
                        $response['data'][] = "";
                        return $response;
                    }
                    $trans = App\Models\Trans::whereRaw('trans_code="'.$order_id.'"')->get();
                    foreach ($trans as $item) {
                        $item->trans_is_paid = 1;
                        $item->trans_paid_date = $date;
                        $item->trans_paid_note = 'pembayaran dengan Midtrans selesai.';
                        $item->trans_note = 'pembayaran dengan Midtrans telah selesai.';
                        $item->save();
                    }
                    // update sys_trans_detail
                    foreach ($trans_detail as $item) {
                        $trans_detail = App\Models\Trans_detail::findOrFail($item->id);
                        // to transfer
                        $trans_detail->trans_detail_status = 3;
                        $trans_detail->trans_detail_transfer = 1;
                        $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                        $trans_detail->trans_detail_note = $trans_detail->trans_detail_note.' Transfer Successfully.';
                        $trans_detail->save();
                        $response['data'][] = $trans_detail;
                    }
                    // send email
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
                        $response['message'] .= ' ,'.$send_notif['message'];
                    }
                }else{
                    $type = ((str_contains(strtolower($order_id), 'hl-'))?'hotlist'
                        :((str_contains(strtolower($order_id), 'ikl-'))?'iklan'
                        :((str_contains(strtolower($order_id), 'pc-'))?'pincode':'')));
                    switch ($type) {
                        case 'hotlist':
                            // update sys_trans_hotlist
                            $trans_detail = App\Models\Trans_hotlist::whereRaw('trans_hotlist_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_hotlist_status = 3;
                            $trans_detail->trans_hotlist_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_hotlist_response_note = 'Transfer Successfully. approved by system.';
                            $trans_detail->trans_hotlist_note = $trans_detail->trans_hotlist_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $update_wallet = [
                                    'user_id'=>$trans_detail->trans_hotlist_user_id,
                                    'wallet_type'=>6,
                                    'amount'=>$trans_detail->paket->paket_hotlist_amount + $trans_detail->paket->paket_hotlist_bonus,
                                    'note'=>'Update wallet hotlist dengan pembelian paket '.$trans_detail->paket->paket_hotlist_name.'.',
                                ];
                                $saldo = FunctionLib::update_wallet($update_wallet);
                            $response['data'][] = $trans_detail;
                        break;
                        case 'pincode':
                            // update sys_trans_pincode
                            $trans_detail = App\Models\Trans_pincode::whereRaw('trans_pincode_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_pincode_status = 3;
                            $trans_detail->trans_pincode_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_pincode_response_note = 'Transfer Successfully. approved by system.';
                            $trans_detail->trans_pincode_note = $trans_detail->trans_detail_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $update_wallet = [
                                    'user_id'=>$trans_detail->trans_hotlist_user_id,
                                    'wallet_type'=>5,
                                    'amount'=>($trans_detail->paket->paket_pincode_amount + $trans_detail->paket->paket_pincode_bonus),
                                    'note'=>'Update wallet pincode dengan pembelian paket '.$trans_detail->paket->paket_pincode_name.'.',
                                ];
                                $saldo = FunctionLib::update_wallet($update_wallet);
                            $response['data'][] = $trans_detail;
                        break;
                        case 'iklan':
                            // update sys_trans_iklan
                            $trans_detail = App\Models\Trans_iklan::whereRaw('trans_iklan_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_iklan_status = 3;
                            $trans_detail->trans_iklan_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_iklan_response_note = ' Transfer Successfully. approved by system.';
                            $trans_detail->trans_iklan_note = $trans_detail->trans_iklan_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $update_wallet = [
                                    'user_id'=>$trans_detail->trans_hotlist_user_id,
                                    'wallet_type'=>4,
                                    'amount'=>($trans_detail->paket->paket_iklan_amount + $trans_detail->paket->paket_iklan_bonus),
                                    'note'=>'Update wallet iklan dengan pembelian paket '.$trans_detail->paket->paket_iklan_name.'.',
                                ];
                                $saldo = FunctionLib::update_wallet($update_wallet);
                            $response['data'][] = $trans_detail;
                        break;
                        default:
                            $response['status'] = 500;
                            $response['message'] = 'Transfer Gagal!';
                            $response['data'][] = "";
                        break;
                    }
                }
                return $response;
            break;
            case 'pending':
            break;
            case 'expire':
                $in = 'select id from sys_trans where trans_code = "'.$order_id.'"';
                $trans_detail = App\Models\Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
                if($trans_detail){
                    foreach ($trans_detail as $item) {
                        $trans_detail = App\Models\Trans_detail::findOrFail($item->id);
                        // to transfer
                        $trans_detail->trans_detail_status = 3;
                        $trans_detail->trans_detail_transfer = 2;
                        $trans_detail->trans_detail_transfer_is_cancel = 1;
                        $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                        $trans_detail->trans_detail_note = $trans_detail->trans_detail_note.' Transfer Expired, Transaction cancelled.';
                        $trans_detail->save();
                    }
                }else{
                    $type = ((str_contains(strtolower($order_id), 'hl-'))?'hotlist'
                        :((str_contains(strtolower($order_id), 'ikl-'))?'iklan'
                        :((str_contains(strtolower($order_id), 'pc-'))?'pincode':'')));
                    switch ($type) {
                        case 'hotlist':
                            $trans_detail = App\Models\Trans_hotlist::whereRaw('trans_hotlist_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_hotlist_status = 4;
                            $trans_detail->trans_hotlist_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_hotlist_response_note = 'Transfer Expired. updated by system.';
                            $trans_detail->trans_hotlist_note = $trans_detail->trans_hotlist_note.' Transfer Expired. updated by system.';
                            $trans_detail->save();
                        break;
                        case 'pincode':
                            $trans_detail = App\Models\Trans_pincode::whereRaw('trans_pincode_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_pincode_status = 4;
                            $trans_detail->trans_pincode_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_pincode_response_note = 'Transfer Expired. updated by system.';
                            $trans_detail->trans_pincode_note = $trans_detail->trans_detail_note.' Transfer Expired. updated by system.';
                            $trans_detail->save();
                        break;
                        case 'iklan':
                            $trans_detail = App\Models\Trans_iklan::whereRaw('trans_iklan_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_iklan_status = 4;
                            $trans_detail->trans_iklan_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_iklan_response_note = 'Transfer Expired. updated by system.';
                            $trans_detail->trans_iklan_note = $trans_detail->trans_iklan_note.' Transfer Expired. updated by system.';
                            $trans_detail->save();
                        break;
                        default:
                            $response['status'] = 500;
                            $response['message'] = 'Transfer Expired!';
                        break;
                    }
                }
                return $response;
            break;
            case 'deny':
                $in = 'select id from sys_trans where trans_code = "'.$order_id.'"';
                $trans_detail = App\Models\Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
                if($trans_detail){
                    foreach ($trans_detail as $item) {
                        $trans_detail = App\Models\Trans_detail::findOrFail($item->id);
                        // to transfer
                        $trans_detail->trans_detail_status = 4;
                        $trans_detail->trans_detail_transfer = 2;
                        $trans_detail->trans_detail_transfer_is_cancel = 1;
                        $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                        $trans_detail->trans_detail_note = $trans_detail->trans_detail_note.' Transfer denied, Transaction cancelled.';
                        $trans_detail->save();
                    }
                }else{
                    $type = ((str_contains(strtolower($order_id), 'hl-'))?'hotlist'
                        :((str_contains(strtolower($order_id), 'ikl-'))?'iklan'
                        :((str_contains(strtolower($order_id), 'pc-'))?'pincode':'')));
                    switch ($type) {
                        case 'hotlist':
                            $trans_detail = App\Models\Trans_hotlist::whereRaw('trans_hotlist_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_hotlist_status = 4;
                            $trans_detail->trans_hotlist_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_hotlist_response_note = 'Transfer deny. updated by system.';
                            $trans_detail->trans_hotlist_note = $trans_detail->trans_hotlist_note.' Transfer deny. updated by system.';
                            $trans_detail->save();
                        break;
                        case 'pincode':
                            $trans_detail = App\Models\Trans_pincode::whereRaw('trans_pincode_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_pincode_status = 4;
                            $trans_detail->trans_pincode_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_pincode_response_note = 'Transfer deny. updated by system.';
                            $trans_detail->trans_pincode_note = $trans_detail->trans_detail_note.' Transfer deny. updated by system.';
                            $trans_detail->save();
                        break;
                        case 'iklan':
                            $trans_detail = App\Models\Trans_iklan::whereRaw('trans_iklan_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_iklan_status = 4;
                            $trans_detail->trans_iklan_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_iklan_response_note = ' Transfer deny. updated by system.';
                            $trans_detail->trans_iklan_note = $trans_detail->trans_iklan_note.' Transfer deny. updated by system.';
                            $trans_detail->save();
                        break;
                        default:
                            $response['status'] = 500;
                            $response['message'] = 'Transfer Denied!';
                        break;
                    }
                }
                return $response;
            break;
            default:
                $response['status'] = 500;
                $response['message'] = 'Transfer Gagal!';
                return $response;
            break;
        }
    }

    public static function setActive(string $path, string $class_name = "active-page")
    {
        return Request::path() === $path ? $class_name : "";
    }
    /**
    * @param
    * @return
    **/
    public static function user_address($id=0) {
        $address = "";
        if($id != 0){
            $item = App\Models\User_detail::where('user_detail_user_id', $id)->first();
            $subdistrict = App\Models\Subdistrict::whereId($item->user_detail_subdist)->pluck('subdistrict_name')[0];
            $city = App\Models\City::whereId($item->user_detail_city)->pluck('city_name')[0];
            $province = App\Models\Province::whereId($item->user_detail_province)->pluck('province_name')[0];
            $address = $item->user_detail_address.', '.$subdistrict.', '.$city.', '.$province;
        }
        return $address;
    }

    public static function count_sell($id = 0, $status="success"){
        if($id == 0){
            $id = Auth::id();
        }
        $where = "1";
        $where .= ' AND sys_trans_detail.trans_detail_is_cancel = 1';
        $where .= ' AND sys_trans_detail.trans_detail_status IN (5, 6)';
        $where .= ' AND trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id='.$id.')';
        if($status !== 'success'){
            $where .= ' AND sys_komplain.id IS NOT NULL';
        }else{
            $where .= ' AND sys_komplain.id IS NULL';
        }
        $total = App\Models\Trans_detail::whereRaw($where)
            ->leftJoin('sys_komplain', 'sys_trans_detail.id', '=', 'sys_komplain.komplain_trans_id')
            ->count();
        return $total;
    }

    public static function get_saldo($type = 0, $id = 0){
        if($id == 0){
            $id = Auth::id();
        }
        $where = 'wallet_user_id ='.$id;
        if($type !== 0){
            $where .= ' AND wallet_type ='.$type;
        }
        $saldo = App\Models\Wallet::whereRaw($where)->pluck('wallet_ballance');
        return $saldo[0];
    }

    /******/
    public static function sum_trans($status = "", $id = 0, $type = 'buyer'){
        $where = "1";
        // check transaksi cancel
        if($status !== ""){
            if($status == 7){
                $where .= ' AND sys_trans_detail.trans_detail_is_cancel = 1';
                $where .= ' AND sys_komplain.id IS NULL';
            }elseif($status == 8){
                $where .= ' AND sys_trans_detail.trans_detail_is_cancel = 1';
                $where .= ' AND sys_komplain.id IS NOT NULL';
            }else{
                $where .= " AND sys_trans_detail.trans_detail_status IN (".$status.")";
                $where .= " AND sys_trans_detail.trans_detail_is_cancel != 1";
            }
        }
        $total = App\Models\Trans_detail::whereRaw($where)
            ->leftJoin('sys_komplain', 'sys_trans_detail.id', '=', 'sys_komplain.komplain_trans_id');
        if($id != 0){
            if($type == 'seller'){
                $total = $total->whereRaw("trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".$id.")");
            }else{
                $total = $total->leftjoin('sys_trans', 'sys_trans.id', 'sys_trans_detail.trans_detail_trans_id')
                    ->where("trans_user_id", $id);
            }
        }
        $total = $total->get()->toArray();
        $total = FunctionLib::array_sum_key($total, 'trans_detail_amount_total');
        return $total;
    }

    /**
    * @param
    * @return
    **/
    public static function count_trans_pincode($status = "", $id = 0){
        $where = 1;
        if($status !== ""){
            $where .= " AND trans_pincode_status = ".$status;
        }
        $total = App\Models\Trans_pincode::whereRaw($where);
        if($id != 0){
            $total = $total->where("trans_pincode_user_id", $id);
        }
        $total = $total->count();
        return $total;
    }

    /**
    * @param
    * @return
    **/
    public static function count_trans_iklan($status = "", $id = 0){
        $where = 1;
        if($status !== ""){
            $where .= " AND trans_iklan_status = ".$status;
        }
        $total = App\Models\Trans_iklan::whereRaw($where);
        if($id != 0){
            $total = $total->where("trans_iklan_user_id", $id);
        }
        $total = $total->count();
        return $total;
    }

    /**
    * @param
    * @return
    **/
    public static function count_trans_hotlist($status = "", $id = 0){
        $where = 1;
        if($status !== ""){
            $where .= " AND trans_hotlist_status = ".$status;
        }
        $total = App\Models\Trans_hotlist::whereRaw($where);
        if($id != 0){
            $total = $total->where("trans_hotlist_user_id", $id);
        }
        $total = $total->count();
        return $total;
    }

    /******/
    public static function count_message(){
        if(\Auth::check()){
            $where = 'message_to_id = '.Auth::id();
            $where .= ' AND message_is_read = 0';
            $message = App\Models\Message::whereRaw($where)->get();
        }else{
            $message = App\Models\Message::whereRaw('1 = 0')->get();
        }
        // dd($response['message']);
        return $message;
    }

    /**
     * check status midtrans.
     * @return void
     */
    public static function midtrans_status($order_id){
        Veritrans_Config::$serverKey = 'Mid-server-7Y-NEaLe8gTOb4xVRDip6WyC';
        Veritrans_Config::$isProduction = true;
        Veritrans_Config::$isSanitized = true;
        Veritrans_Config::$is3ds = true;
        
        // Veritrans_Config::$serverKey = env('VERYTRANS_KEY');
        // Veritrans_Config::$isSanitized = env('VERYTRANS_SANITIZED');
        // Veritrans_Config::$is3ds = env('VERYTRANS_3DS');
        try {
            $status = Veritrans_Transaction::status($order_id);
            return $status;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
    * approve midtrans
    *
    **/
    public static function midtrans_approve($order_id){
        Veritrans_Config::$serverKey = 'Mid-server-7Y-NEaLe8gTOb4xVRDip6WyC';
        Veritrans_Config::$isProduction = true;
        Veritrans_Config::$isSanitized = true;
        Veritrans_Config::$is3ds = true;
        
        // Veritrans_Config::$serverKey = env('VERYTRANS_KEY');
        // Veritrans_Config::$isSanitized = env('VERYTRANS_SANITIZED');
        // Veritrans_Config::$is3ds = env('VERYTRANS_3DS');
        try {
            $approve = Veritrans_Transaction::approve($order_id);
            return $approve;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
    * cancel modtrans
    *
    **/
    public static function midtrans_cancel($order_id){
        Veritrans_Config::$serverKey = env('VERYTRANS_KEY');
        Veritrans_Config::$isSanitized = env('VERYTRANS_SANITIZED');
        Veritrans_Config::$is3ds = env('VERYTRANS_3DS');
        try {
            $cancel = Veritrans_Transaction::cancel($order_id);
            return $cancel;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
    * check user have conf shipment
    *
    **/
    public static function class_arr(){
        $arr = ['primary', 'success', 'default', 'warning', 'danger'];
        return $arr;
    }

    /**
    * check user have conf shipment
    *
    **/
    public static function have_shipment($id, $user_id){
        $user = App\Models\User_shipment::where('user_shipment_user_id', $user_id)->pluck('user_shipment_shipment_id')->toArray();
        // $shipment = App\Models\Shipment::pluck('id')->toArray();
        return (bool)in_array($id, $user);
    }

    /**
    * Upload image
    *
    **/
    public static function doUpload($file, $path, $field=""){
        $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(5).'.'.$file->getClientOriginalExtension();
        $imagesize = $file->getClientSize();
        $imagetmp = $file->getPathName();
        if($field !== '' && $field !== null){
            File::delete($path . '/' . $field);   
        }
        if(file_exists($path . '/' . $imagename)){// || file_exists($path . '/thumb' . $imagename)){
            $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(6).'.'.$file->getClientOriginalExtension();
        }
        $file->move($path, $imagename);
        return $imagename;
    }
    /**
    * date indo
    * @param $date date, $day boolean
    **/
    public static function datetime_indo($tanggal, $cetak_hari = false, $type="date")
    {
        if($type == 'full'){
            $time = date("H:i:s",strtotime($tanggal));
            $tanggal = date('Y-m-d', strtotime($tanggal));
        }
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split    = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0] . ' at ' .$time;
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }
    /**
    * date indo
    * @param $date date, $day boolean
    **/
    public static function date_indo($tanggal, $cetak_hari = false, $type="date")
    {
        if($type == 'full'){
            $tanggal = date('Y-m-d', strtotime($tanggal));
        }
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split    = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }

    /**
    * date indo
    * @param $date date, $day boolean
    **/
    public static function date_en($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split    = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }
    /**
    * @param
    * @return
    **/
    public static function address_info($id=0) {
        $address = "";
        if($id != 0){
            $item = App\Models\User_address::whereId($id)->first();
            $subdistrict = App\Models\Subdistrict::whereId($item->user_address_subdist)->pluck('subdistrict_name')[0];
            $city = App\Models\City::whereId($item->user_address_city)->pluck('city_name')[0];
            $province = App\Models\Province::whereId($item->user_address_province)->pluck('province_name')[0];
            $address = $item->user_address_address.', '.$subdistrict.', '.$city.', '.$province;
        }
        return $address;
    }

    /**
    * @param
    * @return
    **/
    public static function page($type="member") {
        switch ($type) {
            case 'member':
                if(Auth::guest())
                {
                    $return = App\Models\Page::where('page_role_id', 0)
                        ->where('page_status', 1)
                        ->where('page_kategori', 'member');
                }else{
                    $return = App\Models\Page::whereIn('page_role_id', [0, Auth::user()->role])
                        ->where('page_status', 1)
                        ->where('page_kategori', 'member');
                }
            break;
            case 'seller':
                if(Auth::guest())
                {
                    $return = App\Models\Page::where('page_role_id', 0)
                        ->where('page_status', 1)
                        ->where('page_kategori', 'seller');
                }else{
                    $return = App\Models\Page::whereIn('page_role_id', [0, Auth::user()->role])
                        ->where('page_status', 1)
                        ->where('page_kategori', 'seller');
                }
            break;
            case 'greenplaza':
                if(Auth::guest())
                {
                    $return = App\Models\Page::where('page_role_id', 0)
                        ->where('page_status', 1)
                        ->where('page_kategori', 'greenplaza');
                }else{
                    $return = App\Models\Page::whereIn('page_role_id', [0, Auth::user()->role])
                        ->where('page_status', 1)
                        ->where('page_kategori', 'greenplaza');
                }
            break;
            case 'aboutus':
                if(Auth::guest())
                {
                    $return = App\Models\Page::where('page_role_id', 0)
                        ->where('page_status', 1)
                        ->where('page_kategori', 'aboutus');
                }else{
                    $return = App\Models\Page::whereIn('page_role_id', [0, Auth::user()->role])
                        ->where('page_status', 1)
                        ->where('page_kategori', 'aboutus');
                }
            break;
            default:
                $page = [];
                break;
        }
        return $return;
    }

    /**
    * @param
    * @return
    **/
    public static function config_arr($type="profil") {
        switch ($type) {
            case 'bank':
                $arr = App\Models\Conf_config::where('configs_name', 'LIKE', 'bank_%')->pluck('configs_name');
                break;
            case 'profil':
                $arr = App\Models\Conf_config::where('configs_name', 'LIKE', 'profil_%')->pluck('configs_name');
                break;
            case 'transaksi':
                $arr = App\Models\Conf_config::where('configs_name', 'LIKE', 'transaksi_%')->pluck('configs_name');
                break;
            default:
                $arr = [];
                break;
        }
        return $arr;
    }

	/**
	* @param
	* @return
	**/
    public static function str_rand($length = 5) {
    	return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}

    /**
    * @param
    * @return
    **/
    public static function get_config($type, $status = 1){
        try {
            $value = App\Models\Conf_config::where('configs_status', '=', $status)
                ->where('configs_name', $type)
                ->pluck('configs_value')[0];
        }
        catch (\Exception $e) {
            $value = '';
        }
        return $value;
    } 

    /**
    * @param
    * @return
    **/
    public static function number_to_text($numb, $decimal=2){
        return number_format($numb,$decimal,",",".");
    }

    /**
    * @param
    * @return
    **/
    public static function category_by_parent($parent_cat= 0, $limit= 8, $where= 1){
        $cat = Illuminate\Support\Facades\DB::select("SELECT GROUP_CONCAT(lv SEPARATOR ',') as lv FROM (
            SELECT @pv:=(SELECT GROUP_CONCAT(id SEPARATOR ',') FROM sys_category WHERE
            FIND_IN_SET(category_parent_id, @pv)) AS lv FROM sys_category
            JOIN (SELECT @pv:=$parent_cat)tmp
            WHERE category_parent_id IN (@pv)) a")[0];
        $cat = $cat->lv.",".$parent_cat;
        $return = App\Models\Category::whereIn("id", explode(",",$cat))
            ->whereRaw($where);
        return $return;

    }

    /**
    * @param
    * @return
    **/
    public static function produk_by_category($parent_cat= 0, $limit= 8, $where= 1, $order= "RAND()"){
        $cat = Illuminate\Support\Facades\DB::select("SELECT GROUP_CONCAT(lv SEPARATOR ',') as lv FROM (
            SELECT @pv:=(SELECT GROUP_CONCAT(id SEPARATOR ',') FROM sys_category WHERE
            FIND_IN_SET(category_parent_id, @pv)) AS lv FROM sys_category
            JOIN (SELECT @pv:=$parent_cat)tmp
            WHERE category_parent_id IN (@pv)) a")[0];
        $cat = $cat->lv.",".$parent_cat;
        $return = App\Models\Produk::whereIn("produk_category_id", explode(",",$cat))
            ->whereRaw($where)
            ->orderByRaw($order)
            ->skip(0)
            ->take($limit);
        return $return;
    }

    /**
    * @param
    * @return
    **/
    public static function produk_by($status, $val= 0, $limit= 8, $where= 1, $order= "RAND()"){
        // $where = $where.' AND produk_status=1';
        switch ($status) {
            case 'category':
                    $cat = Illuminate\Support\Facades\DB::select("SELECT GROUP_CONCAT(lv SEPARATOR ',') as lv FROM (
                        SELECT @pv:=(SELECT GROUP_CONCAT(id SEPARATOR ',') FROM sys_category WHERE
                        FIND_IN_SET(category_parent_id, @pv)) AS lv FROM sys_category
                        JOIN (SELECT @pv:=$val)tmp
                        WHERE category_parent_id IN (@pv)) a")[0];
                    $cat = $cat->lv.",".$val;
                    $return = App\Models\Produk::whereIn("produk_category_id", explode(",",$cat))
                        ->whereRaw($where)
                        ->orderByRaw($order)
                        ->skip(0)
                        ->take($limit);
                break;
            case 'brand':
                    $return = App\Models\Produk::where("produk_brand_id", $val)
                        ->whereRaw($where)
                        ->orderByRaw($order)
                        ->skip(0)
                        ->take($limit);
                break;
            
            default:
                    $return = [];
                break;
        }
        return $return;
    }

    /**
    * @param
    * @return
    **/
    public static function add_chart($produk_id){
        $produk = App\Models\Produk::where("id", $produk_id)->first();
        return true;

    }

    /**
    * @param
    * @return
    **/
    public static function insert_province(){
        $data = [];
        $status = 200;
        $message = 'Province added!';

        $province = RajaOngkir::province($data);
        $province = json_decode($province, true);
        $province = $province['rajaongkir']['results'];
        foreach ($province as $item) {
            $province = new App\Models\Province;
            $province->id = $item['province_id'];
            $province->province_name = $item['province'];
            $province->save();
        }
        if(!$province){
            $status = 500;
            $message = 'Province Not added!';
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param
    * @return
    **/
    public static function insert_city($id = 0){
        $data = [];
        $status = 200;
        $message = 'Province added!';

        $city = RajaOngkir::city($data);
        $city = json_decode($city, true);
        $city = $city['rajaongkir']['results'];
        foreach ($city as $item) {
            $city = new App\Models\City;
            $city->id = $item['city_id'];
            $city->city_province_id = $item['province_id'];
            $city->city_province_name = $item['province'];
            $city->city_name = $item['city_name'];
            $city->city_type = $item['type'];
            $city->city_postal_code = $item['postal_code'];
            $city->save();
        }
        if(!$city){
            $status = 500;
            $message = 'Province Not added!';
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param
    * @return
    **/
    public static function insert_subdistrict($offset = 0, $limit = 100){
        $data = [];
        $status = 200;
        $message = 'Province added!';

        // $city = FunctionLib::get_city();
        $city = App\Models\City::offset($offset)
                ->limit($limit)->pluck('id');
        foreach ($city as $item) {
            $data = ['id' => $item];
            $subdistrict = RajaOngkir::subdistrict($data);
            $subdistrict = json_decode($subdistrict, true);
            $subdistrict = $subdistrict['rajaongkir']['results'];
            foreach ($subdistrict as $item) {
                // dd($item);
                $subdistrict = new App\Models\Subdistrict;
                $subdistrict->id = $item['subdistrict_id'];
                $subdistrict->subdistrict_province_id = $item['province_id'];
                $subdistrict->subdistrict_province_name = $item['province'];
                $subdistrict->subdistrict_city_id = $item['city_id'];
                $subdistrict->subdistrict_city_name = $item['city'];
                $subdistrict->subdistrict_city_type = $item['type'];
                $subdistrict->subdistrict_name = $item['subdistrict_name'];
                $subdistrict->save();
            }
        }
        if(!$subdistrict){
            $status = 500;
            $message = 'Province Not added!';
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param
    * @return
    **/
    public static function get_province($id = 0, $type='rajaongkir'){
        if($type == 'rajaongkir'){
            $data = [];
            if($id != 0){
                $data = ['id' => $id];
            }
            $province = RajaOngkir::province($data);
            $province = json_decode($province, true);
            $province = $province['rajaongkir']['results'];
            return $province;
        }
        if($id != 0){
            $province = App\Models\Province::whereId($id)->get();
        }else{
            $province = App\Models\Province::all();
        }
        return $province;
    }

    /**
    * @param
    * @return
    **/
    public static function get_city($id = 0, $type='rajaongkir'){
        if($type == 'rajaongkir'){
            $data = [];
            if($id != 0){
                $data = ['id' => $id];
            }
            $city = RajaOngkir::city($data);
            $city = json_decode($city, true);
            $city = $city['rajaongkir']['results'];
            return $city;
        }
        if($id != 0){
            $province = App\Models\City::whereRaw('city_province_id='.$id)->get();
        }else{
            $province = App\Models\City::all();
        }
        return $province;
    }

    /**
    * @param
    * @return
    **/
    public static function get_subdistrict($id = 0, $type='rajaongkir'){
        if($type == 'rajaongkir'){
            $data = [];
            if($id != 0){
                $data = ['id' => $id];
            }
            $subdistrict = RajaOngkir::subdistrict($data);
            $subdistrict = json_decode($subdistrict, true);
            $subdistrict = $subdistrict['rajaongkir']['results'];
            return $subdistrict;
        }
        if($id != 0){
            $province = App\Models\Subdistrict::whereRaw('subdistrict_city_id='.$id)->get();
        }else{
            $province = App\Models\Subdistrict::all();
        }
        return $province;
    }

    /**
    * @param
    * @return
    **/
    public static function get_waybill($id = 0){
        $data = [];
        $status = 'Receipt Number is not valid';
        if($id != 0){
            $item = App\Models\Trans_detail::whereId($id)->first();
            if($item){
                $req = [
                    'data' => [
                        'waybill' => $item->trans_detail_no_resi,
                        'courier' => strtolower($item->shipment->shipment_name),
                    ]
                ];

                $shipment = RajaOngkir::waybill($req);
                $shipment = json_decode($shipment, true);
                if($shipment['rajaongkir']['status']['code'] && $shipment['rajaongkir']['status']['code'] == 200){
                    if($shipment['rajaongkir']['result']['delivered'] == true){
                        $status = 'Sent';
                    }else{
                        $status = 'On Process';
                    }
                }else{
                    $status = 'Receipt Number is not valid';
                }
            }
        }
        return $status;
    }

    /**
    * @param
    * @return
    **/
    public static function count_produk($status = "", $id = 0){
        $where = 1;
        if($status !== ""){
            $where .= " AND produk_status = ".$status;
        }
        $total = App\Models\Produk::whereRaw($where);
        if($id != 0){
            $total = $total->where("produk_seller_id", $id);
        }
        $total = $total->count();
        return $total;
    }

    public static function count_produk_admin($status = "", $id = 0){
        $where = 1;
        if($status !== ""){
            $where .= " AND produk_status = ".$status;
        }
        $total = App\Models\Produk::whereRaw($where);
        if($id != 0){
            $total = $total->where("produk_seller_id", $id);
        }
        $total = $total->count();
        return $total;
    }

    /**
    * @param
    * @return
    **/
    public static function count_produk_hot($status = "", $id = 0){
        $where = 1;
        $where .= " AND produk_is_hot = 1";
        if($status !== ""){
            $where .= " AND produk_status = ".$status;
        }
        $total = App\Models\Produk::whereRaw($where);
        if($id != 0){
            $total = $total->where("produk_seller_id", $id);
        }
        $total = $total->count();
        return $total;
    }


    /**
    * @param
    * @return
    **/
    public static function data_user_by_id($id= 0){
        $where = "id = ".$id;
        $data = App\User::whereRaw($where)->first();
        return $data;
    }

    public static function array_sum_key( $arr, $index = null ){
        if(!is_array( $arr ) || sizeof( $arr ) < 1){
            return 0;
        }
        $ret = 0;
        foreach( $arr as $id => $data ){
            if( isset( $index )  ){
                $ret += (isset( $data[$index] )) ? $data[$index] : 0;
            }else{
                $ret += $data;
            }
        }
        return $ret;
    }

    /**
    * @param $status = status transaksi
    * @param $id = id user
    * @param $type = status user
    * @return
    **/
    public static function count_trans($status = "", $id = 0, $type = 'buyer'){
        $where = "1";
        // check transalsi cancel
        if($status !== ""){
            if($status == 7){
                $where .= ' AND sys_trans_detail.trans_detail_is_cancel = 1';
                $where .= ' AND sys_komplain.id IS NULL';
            }elseif($status == 8){
                $where .= ' AND sys_trans_detail.trans_detail_is_cancel = 1';
                $where .= ' AND sys_komplain.id IS NOT NULL';
            }else{
                $where .= " AND sys_trans_detail.trans_detail_status IN (".$status.")";
                $where .= " AND sys_trans_detail.trans_detail_is_cancel != 1";
            }
        }
        $total = App\Models\Trans_detail::whereRaw($where)
            ->leftJoin('sys_komplain', 'sys_trans_detail.id', '=', 'sys_komplain.komplain_trans_id');
        if($id != 0){
            if($type == 'seller'){
                $total = $total->whereRaw("trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".$id.")");
            }else{
                $total = $total->leftjoin('sys_trans', 'sys_trans.id', 'sys_trans_detail.trans_detail_trans_id')
                    ->where("trans_user_id", $id);
            }
        }
        $total = $total->count();
        return $total;
    }

    /**
    * @param
    * @return
    **/
    public static function count_user($status = ""){
        $where = 1;
        $arr = [
            0 => ' AND (email_verified_at IS NULL OR email_verified_at = "")',
            1 => ' AND (email_verified_at IS NOT NULL OR email_verified_at != "")',
        ];
        if($status == 2){
        }else{
            if($status !== ""){
                $status_qry = $arr[$status];
                $where .= $status_qry;
            }
        }
        $total = App\User::whereRaw($where)->count();
        return $total;
    }

    /**
    * @param
    * @return
    **/
    public static function count_res_kom($status = ""){
        $where = 1;
        if($status !== ""){
            $where .= " AND komplain_status = ".$status;
        }
        $total = App\Models\Komplain::whereRaw($where)->count();
        return $total;
    }

    /******/
    public static function createXML($param=[]) {
        extract($param);
        $title = $title;
        $rowCount = count($data);
        
        //create the xml document
        $xmlDoc = new DOMDocument();
        
        $root = $xmlDoc->appendChild($xmlDoc->createElement("data_info"));
        $root->appendChild($xmlDoc->createElement("title",$title));
        $root->appendChild($xmlDoc->createElement("totalRows",$rowCount));
        $tabUsers = $root->appendChild($xmlDoc->createElement('rows'));
        
        foreach($data as $item){
            if(!empty($item)){
                $tabData = $tabUsers->appendChild($xmlDoc->createElement('data'));
                foreach($item as $key=>$value){
                    $tabData->appendChild($xmlDoc->createElement($key, $value));
                }
            }
        }
        
        header("Content-Type: text/plain");
        
        //make the output pretty
        $xmlDoc->formatOutput = true;

        //save xml file
        $file_name = str_replace(' ', '_',$title).'_'.time().'.xml';
        $public_path = public_path('assets/xml/');
        $xmlDoc->save($public_path . $file_name);
        
        //return xml file name
        return $file_name;
    }

}