<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrderTrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_trans_hotlist', function($table) {
            $table->integer('trans_hotlist_jml')->default(0)->after('trans_hotlist_amount')->comment('total poin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_trans_hotlist', function($table) {
            $table->dropColumn('trans_hotlist_jml');
        });
    }
}
