<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Review extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sys_review');
        // trans komplain
        Schema::create('sys_review', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('review_produk_id')->unsigned()->comment('id produk');
            $table->integer('review_user_id')->unsigned()->comment('id user');
            $table->tinyInteger('review_status')->default(1)->comment('0.non active, 1.active');
            $table->text('review_text');
            $table->timestamps();
            $table->foreign('review_produk_id')
                ->references('id')
                ->on('sys_produk')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('review_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_review');
    }
}
