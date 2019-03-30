<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransIklanQr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_trans_iklan', function ($table) {
            $table->string('trans_iklan_qr')->nullable()->after('trans_iklan_code')->comment('qr code jika pakai masedi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_trans_iklan', function ($table) {
            $table->dropColumn('trans_iklan_qr');
        });
    }
}
