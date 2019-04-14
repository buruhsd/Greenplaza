<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysConfigUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sys_config_user');
        Schema::create('sys_config_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('config_user_id')->unsigned();
            $table->string('config_name');
            $table->text('config_value');
            $table->text('config_note')->nullable();
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
        Schema::drop('sys_config_user');
    }
}
