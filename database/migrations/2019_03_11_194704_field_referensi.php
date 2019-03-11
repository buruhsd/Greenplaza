<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FieldReferensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('sys_withdrawal', function ($table) {
            $table->string('withdrawal_ref')->nullable()->after('withdrawal_wallet_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('sys_withdrawal', function ($table) {
            $table->dropColumn('withdrawal_ref');
        });
    }
}
