<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusCheckoutToSysTransDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_trans_detail', function (Blueprint $table) {
            $table->integer('status_chart')->nullable()->after('trans_detail_is_cancel');
            
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
            $table->dropColumn('status_chart');
            
        });
    }
}
