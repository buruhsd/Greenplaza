<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceMyrToSysProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_produk', function (Blueprint $table) {
            $table->decimal('price_myr', 20, 2)->nullable()->after('produk_price');
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
            $table->dropColumn('price_myr');
            
        });
    }
}
