<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // produk user transaksi wishlist
        Schema::dropIfExists('sys_wishlist');
        Schema::create('sys_wishlist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wishlist_produk_id')->unsigned();
            $table->integer('wishlist_user_id')->unsigned();
            $table->text('wishlist_note')->nullable();
            $table->timestamps();
            $table->foreign('wishlist_produk_id')
                ->references('id')
                ->on('sys_produk')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('wishlist_user_id')
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
        Schema::drop('sys_wishlist');
    }
}
