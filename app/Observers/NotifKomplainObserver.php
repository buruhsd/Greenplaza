<?php
namespace App\Observers;
use App\Models\Komplain;
use App\User;
use App\Notifications\Transaksi;
class NotifKomplainObserver
{
    //listen to creating config
    public function created(Komplain $item)
    {
        $this->setLog("created", $item);
    }
    public function updated(Komplain $item)
    {
        $this->setLog("updated", $item);
    }
    public function deleted(Komplain $item)
    {
        $this->setLog("deleted", $item);
    }
    public function restored(Komplain $item)
    {
        $this->setLog("restored", $item);
    }
    private function setLog($type, $item)
    {
        switch ($type) {
            case 'created':
                $data['title'] = 'Order Komplain';
                $data['route'] = route('member.komplain.index', ['status'=>'new']);
                $data['status'] = 200;
                $data['message'] = "Komplain pembeli untuk transaksi ".$item->trans_detail->trans->trans_code;
                $author = $item->trans_detail->trans->pembeli;
                $item->trans_detail->produk->user->notify(new Transaksi($item->trans_detail,$author,$data));
            break;
            case 'updated':
                $is_done = false;
                if($item->komplain_status == 3){
                    $is_done = true;
                }
                $notif = ($is_done)
                    ?"Komplain transaksi selesai"
                    :"Update Komplain menunggu admin";
                $data['title'] = 'Order Komplain';
                $data['route'] = route('member.komplain.index', ['status'=>'new']);
                $data['status'] = 200;
                $data['message'] = $notif." untuk transaksi ".$item->trans_detail->trans->trans_code;
                $author = $item->trans_detail->trans->pembeli;
                if($is_done){
                    $data['route'] = route('member.komplain.index', ['status'=>'done']);
                    $item->trans_detail->produk->user->notify(new Transaksi($item->trans_detail,$author,$data));
                    $author = User::find(2);
                    $data['route'] = route('member.komplain.buyer', ['status'=>'done']);
                    $item->trans_detail->trans->pembeli->notify(new Transaksi($item->trans_detail,$author,$data));
                }else{
                    $item->trans_detail->produk->user->notify(new Transaksi($item->trans_detail,$author,$data));
                    $item->trans_detail->trans->pembeli->notify(new Transaksi($item->trans_detail,$author,$data));
                }
            break;
            default:
            break;
        }
    }
}