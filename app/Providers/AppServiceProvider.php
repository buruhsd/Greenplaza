<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use File;
use View;

use App\Models\Wallet; 
use App\Observers\WalletLogObserver; 

use App\User; 
use App\Observers\WalletRegisterUserObserver;

use App\Models\Trans_detail; 
use App\Observers\NotifTransaksiObserver;

use App\Models\Message; 
use App\Observers\NotifMessageObserver;

use App\Models\Produk_discuss; 
use App\Observers\NotifDiskusiProdukObserver;

use App\Models\Komplain; 
use App\Observers\NotifKomplainObserver;

use App\Models\Solusi; 
use App\Observers\NotifSolusiObserver;
use \Illuminate\Support\Facades\URL; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot ()
    {
        // URL::forceScheme('https');
        Schema::defaultStringLength(191);
        // ketika ada aktifitas wallet
        Wallet::observe(WalletLogObserver::class);
        // ketika member register
        User::observe(WalletRegisterUserObserver::class);
        // ketika transaksi dibuat atau di update
        Trans_detail::observe(NotifTransaksiObserver::class);
        // ketika ada pesan baru
        Message::observe(NotifMessageObserver::class);
        // ketika ada pesan baru
        Produk_discuss::observe(NotifDiskusiProdukObserver::class);
        // ketika komplain member seller
        Komplain::observe(NotifKomplainObserver::class);
        // ketika solusi member seller
        Solusi::observe(NotifSolusiObserver::class);
        // URL::forceScheme('https');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
