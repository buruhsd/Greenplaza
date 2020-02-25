<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransDetailAmountMyrToSysTransDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_trans_detail', function (Blueprint $table) {
            $table->decimal('trans_detail_amount_myr', 20, 2)->nullable()->after('trans_detail_amount');
            
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
            $table->dropColumn('trans_detail_amount_myr');
            
        });
    }
}
