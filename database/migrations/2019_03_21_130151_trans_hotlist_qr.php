<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransHotlistQr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_trans_hotlist', function ($table) {
            $table->string('trans_hotlist_qr')->nullable()->after('trans_hotlist_code')->comment('qr code jika pakai masedi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_trans_hotlist', function ($table) {
            $table->dropColumn('trans_hotlist_qr');
        });
    }
}
