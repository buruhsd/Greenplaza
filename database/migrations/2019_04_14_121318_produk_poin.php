<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProdukPoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_produk', function ($table) {
            $table->integer('produk_poin')->default(0)->after('produk_brand_id')->comment('% poin untuk pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_produk', function ($table) {
            $table->dropColumn('produk_poin');
        });
    }
}
