<?php
namespace App\Observers;
use App\Models\Trans_detail;
use App\User;
use App\Notifications\Transaksi;
class NotifTransaksiObserver
{
    //listen to creating config
    public function created(Trans_detail $item)
    {
        $this->setLog("created", $item);
    }
    public function updated(Trans_detail $item)
    {
        $this->setLog("updated", $item);
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
}