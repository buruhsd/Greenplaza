<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransPincodeQr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_trans_pincode', function ($table) {
            $table->string('trans_pincode_qr')->nullable()->after('trans_pincode_code')->comment('qr code jika pakai masedi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_trans_pincode', function ($table) {
            $table->dropColumn('trans_pincode_qr');
        });
    }
}
