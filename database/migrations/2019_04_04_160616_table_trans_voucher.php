<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableTransVoucher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_trans_voucher', function (Blueprint $table) {
            $table->integer('trans_voucher_user')->comment('id user');
            $table->string('trans_voucher_trans')->comment('code transaksi');
            $table->string('trans_voucher_code')->comment('code voucher');
            $table->decimal('trans_voucher_amount', 20, 8)->comment('nominal voucher');
            $table->tinyInteger('trans_voucher_status')->default(0)->comment('0 mennunggu,1 dipakai');
            $table->text('trans_voucher_note')->comment('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_trans_voucher');
    }
}
