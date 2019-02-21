<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProdukHeightTransShipService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_trans_detail', function ($table) {
            $table->string('trans_detail_shipment_service')->default("none")->after('trans_detail_shipment_id');
        });
        Schema::table('sys_produk', function ($table) {
            $table->decimal('produk_height', 8, 2)->default(0.00)->after('produk_wide');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_trans_detail', function ($table) {
            $table->dropColumn('trans_detail_shipment_service');
        });
        Schema::table('sys_produk', function ($table) {
            $table->dropColumn('produk_height');
        });
    }
}
