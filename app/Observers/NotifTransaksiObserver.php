<?php
namespace App\Observers;
use App\Models\Trans_detail;
use App\User;
use App\Notifications\Transaksi;
use FunctionLib;
class NotifTransaksiObserver
{
    //listen to creating config
    public function created(Trans_detail $item)
    {
        $this->setLog("created", $item);
    }
    public function updated(Trans_detail $item)
    {
        if(($item->isDirty('trans_detail_status') || $item->isDirty('trans_detail_packing')) 
                && (!$item->is_komplain()) 
                && (!$item->isDirty('trans_detail_is_cancel'))
            ){
            $this->setLog("updated", $item);
        }elseif((!$item->is_komplain()) 
                && ($item->isDirty('trans_detail_is_cancel'))
            ){
            $this->setLog_cancel("updated", $item);
        }
    }
    public function deleted(Trans_detail $item)
    {
        $this->setLog("deleted", $item);
    }
    public function restored(Trans_detail $item)
    {
        $this->setLog("restored", $item);
    }
    private function setLog($type, $item)
    {
        switch ($type) {
            case 'created':
                $data['title'] = 'Order';
                $data['route'] = route('member.transaction.index', ['status'=>'order']);
                $data['status'] = 200;
                $data['message'] = $item->trans->pembeli->name." membeli produk ".$item->produk->produk_name.".";
                $author = $item->trans->pembeli;
                $user = $item->produk->user;
                $user->notify(new Transaksi($item,$author,$data));
            break;
            case 'updated':
                switch ($item->trans_detail_status) {
                    case '2':
                        $data['title'] = 'Order';
                        $data['route'] = route('member.transaction.purchase', ['status'=>'order']);
                        $data['status'] = 200;
                        $data['message'] = "Silahkan lakukan transfer untuk pembelian porduk.";
                        $author = $item->produk->user;
                        $user = $item->trans->pembeli;
                        $user->notify(new Transaksi($item,$author,$data));
                    break;
                    case '3':
                        $data['title'] = 'Order';
                        $data['route'] = route('member.transaction.index', ['status'=>'packing']);
                        $data['status'] = 200;
                        $data['message'] = "transaksi ".$item->trans->trans_code." menunggu kesanggupan anda.";
                        $author = $item->trans->pembeli;
                        $user = $item->produk->user;
                        $user->notify(new Transaksi($item,$author,$data));
                    break;
                    case '4':
                        $data['title'] = 'Order';
                        $data['route'] = route('member.transaction.purchase', ['status'=>'packing']);
                        $data['status'] = 200;
                        $data['message'] = "transaksi ".$item->trans->trans_code." dari toko ".$item->produk->user->user_store." sedang di packing.";
                        $author = $item->produk->user;
                        $user = $item->trans->pembeli;
                        $user->notify(new Transaksi($item,$author,$data));
                    break;
                    case '5':
                        $data['title'] = 'Order';
                        $data['route'] = route('member.transaction.purchase', ['status'=>'shipping']);
                        $data['status'] = 200;
                        $data['message'] = "transaksi ".$item->trans->trans_code." dari toko ".$item->produk->user->user_store." lanjut ke pengiriman.";
                        $author = $item->produk->user;
                        $user = $item->trans->pembeli;
                        $user->notify(new Transaksi($item,$author,$data));
                    break;
                    case '6':
                        $data['title'] = 'Order';
                        $data['route'] = route('member.transaction.index', ['status'=>'dropping']);
                        $data['status'] = 200;
                        $data['message'] = "transaksi ".$item->trans->trans_code." barang sudah diambil pembeli.";
                        $author = $item->trans->pembeli;
                        $user = $item->produk->user;
                        $user->notify(new Transaksi($item,$author,$data));
                    break;
                    default:
                    break;
                }
            break;
            default:
            break;
        }
    }
    // log jika status tidak berubah
    private function setLog_komplain($type, $item){
        $is_cancel = false;
        if($item->trans_detail_is_cancel = 1){
            $is_cancel = true;
        }
        $notif = ($is_cancel)
            ?"terjadi komplain transaksi"
            :"komplain transaksi selesai";
        $data['title'] = 'Order Komplain';
        $data['route'] = route('member.komplain.index', ['status'=>'new']);
        $data['status'] = 200;
        $data['message'] = $notif.", untuk transaksi ".$item->trans->trans_code;
        $author = $item->trans->pembeli;
        if($is_cancel){
            $item->produk->user->notify(new Transaksi($item,$author,$data));
        }else{
            $data['route'] = route('member.komplain.index', ['status'=>'done']);
            $item->produk->user->notify(new Transaksi($item,$author,$data));
            $author = User::find(2);
            $data['route'] = route('member.komplain.buyer', ['status'=>'done']);
            $item->trans->pembeli->notify(new Transaksi($item,$author,$data));
        }
    }

    // log jika status tidak berubah
    private function setLog_cancel($type, $item){
        $is_system = ($item->isDirty('trans_detail_packing') || $item->isDirty('trans_detail_send'))
            ?false
            :true;
        $notif = ($is_system)
            ?"transaksi ".$item->trans->trans_code." telah dicancel oleh system."
            :"transaksi ".$item->trans->trans_code." telah dicancel oleh seller.";
        $data['title'] = 'Order Cancelled';
        $data['route'] = route('member.transaction.purchase', ['status'=>'cancel']);
        $data['status'] = 200;
        $data['message'] = $notif;

        switch ($type) {
            case 'created':
            break;
            case 'updated':
                switch ($item->trans_detail_status) {
                    case '1':
                    case '2':
                    case '3':
                    case '4':
                        if($is_system){
                            $author = User::find(2);
                            $user_get_notif = [$item->trans->pembeli->id, $item->produk->user->id];
                            $item->trans->pembeli->notify(new Transaksi($item,$author,$data));
                            $data['route'] = route('member.transaction.index', ['status'=>'cancel']);
                            $item->produk->user->notify(new Transaksi($item,$author,$data));
                        }else{
                            $author = $item->produk->user;
                            $user = $item->trans->pembeli;
                            $user->notify(new Transaksi($item,$author,$data));
                            // send email
                            $config = [
                                'to' => $item->trans->pembeli->email,
                                'data' => [
                                    'trans_code' => $item->trans->trans_code,
                                    'trans_amount_total' => $item->trans->trans_amount_total,
                                    'user_cancel' => strtoupper($item->produk->user->user_store),
                                    'note' => $item->trans_detail_note,
                                ]
                            ];
                            $send_notif = FunctionLib::trans_cancel_notif($config);
                        }
                    break;
                }
            break;
        }
    }
}