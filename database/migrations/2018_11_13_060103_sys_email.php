<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sys_email');
        Schema::create('sys_email', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email_to');
            $table->string('email_from');
            $table->string('email_subject');
            $table->string('email_type');
            $table->text('email_text');
            $table->tinyInteger('is_send');
            $table->datetime('is_send_datetime');
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
        Schema::drop('sys_email');
    }
}
