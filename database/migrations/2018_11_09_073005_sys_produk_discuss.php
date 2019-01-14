<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysProdukDiscuss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // diskusi produk
        Schema::create('sys_produk_discuss', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produk_discuss_produk_id')->unsigned();
            $table->integer('produk_discuss_user_id')->default(0)->unsigned();
            $table->text('produk_discuss_text');
            $table->tinyInteger('produk_discuss_status')->default(1)->comment('1.tampil');
            $table->tinyInteger('produk_discuss_read_member')->default(0)->comment('1.dibaca member');
            $table->tinyInteger('produk_discuss_read_seller')->default(0)->comment('1.dibaca seller');
            $table->timestamps();
            $table->foreign('produk_discuss_produk_id')
                ->references('id')
                ->on('sys_produk')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('produk_discuss_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        // diskusi produk reply
        Schema::create('sys_produk_discuss_reply', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produk_discuss_reply_discuss_id')->unsigned();
            $table->integer('produk_discuss_reply_user_id')->default(0)->unsigned();
            $table->text('produk_discuss_reply_text');
            $table->tinyInteger('produk_discuss_reply_status')->default(1)->comment('1.tampil');
            $table->tinyInteger('produk_discuss_reply_read_member')->default(0)->comment('1.dibaca member');
            $table->tinyInteger('produk_discuss_reply_read_seller')->default(0)->comment('1.dibaca seller');
            $table->timestamps();
            $table->foreign('produk_discuss_reply_discuss_id')
                ->references('id')
                ->on('sys_produk_discuss')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('produk_discuss_reply_user_id')
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
        Schema::drop('sys_produk_discuss_reply');
        Schema::drop('sys_produk_discuss');
    }
}
