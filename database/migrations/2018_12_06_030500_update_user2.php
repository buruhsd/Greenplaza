<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUser2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_user_detail', function($table) {
            $table->string('user_detail_pass_trx')->nullable()->after('user_detail_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_user_detail', function($table) {
            $table->dropColumn('user_detail_pass_trx');
        });
    }
}
