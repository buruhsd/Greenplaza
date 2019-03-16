<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogTransfer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_transfer', function (Blueprint $table) {
            $table->integer('transfer_user_id')->comment('user id');
            $table->string('transfer_from')->comment('address / username');
            $table->integer('transfer_to_user_id')->comment('user id');
            $table->string('transfer_to')->comment('address / username');
            $table->string('transfer_code_reff')->comment('kode referensi / kode unix / txid / dll');
            $table->string('transfer_type')->comment('satuan nominal #gln #rupiah #dll');
            $table->decimal('transfer_nominal', 20, 8)->comment('nominal transfer');
            $table->text('transfer_response')->comment('respon data');
            $table->text('transfer_note')->comment('keterangan');
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
        Schema::dropIfExists('log_transfer');
    }
}
