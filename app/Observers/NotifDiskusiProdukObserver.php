<?php
namespace App\Observers;
use App\Models\Produk_discuss;
use App\User;
use App\Notifications\NewDiskusiProduk;
class NotifDiskusiProdukObserver
{
    //listen to creating config
    public function created(Produk_discuss $item)
    {
        $this->setLog("created", $item);
    }
    public function updated(Produk_discuss $item)
    {
        $this->setLog("updated", $item);
    }
    public function deleted(Produk_discuss $item)
    {
        $this->setLog("deleted", $item);
    }
    public function restored(Produk_discuss $item)
    {
        $this->setLog("restored", $item);
    }
    private function setLog($type, $item)
    {
        switch ($type) {
            case 'created':
                $data['title'] = 'Diskusi';
                $data['route'] = route('detail', $item->produk->produk_slug);
                $data['status'] = 200;
                $data['message'] = str_limit($item->produk_discuss_text, 50);
                $author = $item->user;
                $user = $item->produk->user;
                $user->notify(new NewDiskusiProduk($item,$author,$data));
            break;
            default:
            break;
        }
    }
}