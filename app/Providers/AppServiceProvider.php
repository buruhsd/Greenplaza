<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use File;
use View;
use App\Models\Wallet; 
use App\User; 
use App\Observers\WalletLogObserver; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // ketika ada aktifitas wallet
        Wallet::observe(WalletLogObserver::class);
        // ketika member register
        User::observe(WalletRegisterUserObserver::class);
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
