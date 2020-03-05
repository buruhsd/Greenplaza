<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransDetailAmountGlnToSysTransDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_trans_detail', function (Blueprint $table) {
            $table->double('trans_detail_amount_gln',20, 8)->default(0.00)->after('trans_detail_amount_myr');
            $table->double('trans_detail_amount_total_gln', 20, 8)->default(0.00)->after('trans_detail_amount_total_myr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_trans_detail', function (Blueprint $table) {
            $table->dropColumn('trans_detail_amount_gln', 'trans_detail_amount_total_gln');
        });
    }
}
