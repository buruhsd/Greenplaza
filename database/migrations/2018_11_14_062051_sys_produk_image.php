<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysProdukImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // produk user transaksi wishlist
        Schema::dropIfExists('sys_produk_image');
        Schema::create('sys_produk_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produk_image_produk_id')->unsigned();
            $table->string('produk_image_image')->nullable();
            $table->timestamps();
            $table->foreign('produk_image_produk_id')
                ->references('id')
                ->on('sys_produk')
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
        Schema::drop('sys_produk_image');
    }
}
