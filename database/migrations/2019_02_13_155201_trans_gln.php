<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransGln extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sys_trans_gln');
        Schema::create('sys_trans_gln', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trans_gln_form');
            $table->string('trans_gln_admin');
            $table->string('trans_gln_to');
            $table->integer('trans_gln_trans_id');
            $table->string('trans_gln_trans_code');
            $table->integer('trans_gln_detail_id');
            $table->string('trans_gln_detail_code');
            $table->decimal('trans_gln_amount', 20, 8);
            $table->decimal('trans_gln_amount_fee', 20, 8);
            $table->decimal('trans_gln_amount_total', 20, 8);
            $table->tinyInteger('trans_gln_status')->default(0);
            $table->text('trans_gln_note')->nullable();
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
        Schema::drop('sys_trans_gln');
    }
}
