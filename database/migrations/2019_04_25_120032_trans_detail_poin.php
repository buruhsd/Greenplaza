<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransDetailPoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_trans_detail', function ($table) {
            $table->integer('trans_detail_persen_poin')->default(0)->after('trans_detail_amount_total')->comment('% poin untuk pembayaran per produk');
            $table->decimal('trans_detail_amount_poin', 20, 8)->default(0.00)->after('trans_detail_persen_poin')->comment('poin untuk pembayaran per produk');
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
            $table->dropColumn('trans_detail_persen_poin');
            $table->dropColumn('trans_detail_amount_poin');
        });
    }
}
