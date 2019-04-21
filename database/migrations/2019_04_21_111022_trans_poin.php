<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransPoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_trans_poin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_poin_trans_id')->comment('sys_trans id');
            $table->integer('trans_poin_persen')->comment('persen poin seller');
            $table->decimal('trans_poin_compare', 20, 8)->comment('harga tukar poin');
            $table->decimal('trans_poin_poin_total', 20, 8)->comment('total poin yg harus dibayar.');
            $table->decimal('trans_poin_total', 20, 8)->comment('total rupiah yg harus dibayar menggunakan poin.');
            $table->tinyInteger('trans_poin_status')->default(0)->comment('0 mennunggu,1 dibayar');
            $table->text('trans_poin_note')->comment('keterangan');
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
        Schema::dropIfExists('sys_trans_poin');
    }
}
