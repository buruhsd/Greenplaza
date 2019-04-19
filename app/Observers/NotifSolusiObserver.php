<?php
namespace App\Observers;
use App\Models\Solusi;
use App\User;
use App\Notifications\Transaksi;
class NotifSolusiObserver
{
    public function updated(Solusi $item)
    {
        $this->setLog("updated", $item);
    }
    private function setLog($type, $item)
    {
        switch ($type) {
            case 'updated':
                $is_done = false;
                if($item->komplain->komplain_status == 3){
                    $is_done = true;
                }
                $notif = ($is_done)
                    ?"Komplain transaksi selesai"
                    :"Update Komplain";
                $data['title'] = 'Order Komplain';
                $data['route'] = route('member.komplain.index', ['status'=>'new']);
                $data['status'] = 200;
                $data['message'] = $notif." untuk transaksi ".$item->komplain->trans_detail->trans->trans_code;
                $author = $item->komplain->trans_detail->trans->pembeli;
                if($is_done){
                    $data['route'] = route('member.komplain.index', ['status'=>'done']);
                    if($item->komplain->trans_detail->produk->user->is_admin()){
                        $data['route'] = route('admin.res_kom.index', ['status'=>'done']);
                    }
                    $item->komplain->trans_detail->produk->user->notify(new Transaksi($item->komplain->trans_detail,$author,$data));
                    $author = User::find(2);
                    $data['route'] = route('member.komplain.buyer', ['status'=>'done']);
                    $item->komplain->trans_detail->trans->pembeli->notify(new Transaksi($item->komplain->trans_detail,$author,$data));
                }else{
                    $data['route'] = route('member.komplain.index', ['status'=>'new']);
                    if($item->komplain->trans_detail->produk->user->is_admin()){
                        $data['route'] = route('admin.res_kom.index', ['status'=>'new']);
                    }
                    $item->komplain->trans_detail->produk->user->notify(new Transaksi($item->komplain->trans_detail,$author,$data));
                    $data['route'] = route('member.komplain.buyer', ['status'=>'new']);
                    $item->komplain->trans_detail->trans->pembeli->notify(new Transaksi($item->komplain->trans_detail,$author,$data));
                }
            break;
            default:
            break;
        }
    }
}