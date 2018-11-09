<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // diskusi produk
        Schema::create('sys_message', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('message_from_id')->unsigned();
            $table->integer('message_to_id')->unsigned();
            $table->string('message_subject');
            $table->text('message_text');
            $table->tinyInteger('message_status_from')->default(1)->comment('tampil from, 1.tampil');
            $table->tinyInteger('message_status_to')->default(1)->comment('tampil to, 1.tampil');
            $table->tinyInteger('message_is_read')->default(0)->comment('1.dibaca');
            $table->timestamps();
            $table->foreign('message_from_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('message_to_id')
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
        Schema::drop('sys_message');
    }
}
