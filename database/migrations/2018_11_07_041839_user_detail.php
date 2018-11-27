<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sys_user_bank');
        Schema::dropIfExists('sys_user_address');
        Schema::dropIfExists('sys_user_detail');
        // detail user
        Schema::create('sys_user_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_detail_user_id')->default(0)->unsigned();
            $table->string('user_detail_jk', 20)->nullable();
            $table->string('user_detail_token');
            $table->string('user_detail_address')->nullable();
            $table->string('user_detail_phone')->nullable();
            $table->string('user_detail_tlp')->nullable();
            $table->integer('user_detail_province')->nullable()->unsigned();
            $table->integer('user_detail_city')->nullable()->unsigned();
            $table->integer('user_detail_subdist')->nullable()->unsigned();
            $table->integer('user_detail_pos')->nullable()->unsigned();
            $table->string('user_detail_image')->nullable();
            $table->integer('user_detail_bank_id')->default(0)->unsigned();
            $table->string('user_detail_bank_name')->nullable();
            $table->string('user_detail_bank_owner')->nullable();
            $table->string('user_detail_bank_no')->nullable();
            $table->tinyInteger('user_detail_status')->default(0);
            $table->text('user_detail_note')->nullable();
            $table->timestamps();
            $table->foreign('user_detail_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // address user
        Schema::create('sys_user_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_address_user_id')->unsigned();
            $table->string('user_address_label');
            $table->string('user_address_owner');
            $table->text('user_address_address');
            $table->string('user_address_phone');
            $table->string('user_address_tlp')->nullable();
            $table->integer('user_address_province')->unsigned();
            $table->integer('user_address_city')->unsigned();
            $table->integer('user_address_subdist')->unsigned();
            $table->integer('user_address_pos')->unsigned();
            $table->tinyInteger('user_address_status')->default(0);
            $table->text('user_address_note')->nullable();
            $table->timestamps();
            $table->foreign('user_address_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // bank user
        Schema::create('sys_user_bank', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_bank_user_id')->unsigned();
            $table->integer('user_bank_bank_id')->default(0)->unsigned();
            $table->string('user_bank_name');
            $table->string('user_bank_owner');
            $table->string('user_bank_no');
            $table->tinyInteger('user_bank_status')->default(0);
            $table->text('user_bank_note')->nullable();
            $table->timestamps();
            $table->foreign('user_bank_user_id')
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
        Schema::drop('sys_user_detail');
        Schema::drop('sys_user_address');
        Schema::drop('sys_user_bank');
    }
}
