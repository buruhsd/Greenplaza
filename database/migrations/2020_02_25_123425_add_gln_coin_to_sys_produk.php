<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGlnCoinToSysProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_produk', function (Blueprint $table) {
            $table->double('gln_coin', 20, 8)->nullable()->after('price_myr');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_produk', function (Blueprint $table) {
            $table->dropColumn('gln_coin');
            
        });
    }
}
