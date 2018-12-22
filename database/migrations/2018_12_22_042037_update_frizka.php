<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFrizka extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('conf_grade');
        Schema::create('conf_grade', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grade_member_name')->comment('nama paket');
            $table->decimal('grade_member_range', 20, 2)->comment('harga paket');
            $table->tinyInteger('grade_member_status')->default(1)->comment('1 seller, 2 member');
            $table->timestamps();
        });
        Schema::dropIfExists('conf_official_email');
        Schema::create('conf_official_email', function (Blueprint $table) {
            $table->increments('id');
            $table->string('official_email_email')->comment('email');
            $table->text('official_email_note')->comment('keterangan');
            $table->timestamps();
        });
        Schema::dropIfExists('conf_iklan');
        Schema::create('conf_iklan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iklan_name')->comment('nama iklan');
            $table->decimal('iklan_price', 20, 2)->comment('haraga iklan');
            $table->tinyInteger('iklan_status')->default(1)->comment('1 free, 2 sold');
            $table->tinyInteger('iklan_type')->default(1)->comment('jenis-jenis iklan');
            $table->text('iklan_note')->comment('keterangan lokasi iklan');
            $table->timestamps();
        });
        Schema::dropIfExists('sys_iklan');
        Schema::create('sys_iklan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iklan_iklan_id')->unsigned()->comment('id iklan');
            $table->integer('iklan_user_id')->unsigned()->comment('id user');
            $table->text('iklan_note')->comment('keterangan');
            $table->timestamps();
            $table->foreign('iklan_iklan_id')
                ->references('id')
                ->on('conf_iklan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('iklan_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        Schema::dropIfExists('log_iklan');
        Schema::create('log_iklan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('iklan_iklan_id')->unsigned()->comment('id iklan');
            $table->integer('iklan_user_id')->unsigned()->comment('id user');
            $table->string('iklan_name')->comment('nama iklan');
            $table->decimal('iklan_price_before', 20, 2)->comment('harga iklan lama');
            $table->decimal('iklan_price_after', 20, 2)->comment('harga iklan terbaru');
            $table->string('iklan_username')->comment('username');
            $table->text('iklan_note')->comment('keterangan');
            $table->timestamps();
        });
        Schema::table('users', function($table) {
            $table->string('user_grade')->default(0)->nullable()->after('user_slug');
            $table->string('user_grade_seller')->default(0)->nullable()->after('user_grade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('user_grade_seller');
            $table->dropColumn('user_grade');
        });
        Schema::drop('log_iklan');
        Schema::drop('sys_iklan');
        Schema::drop('conf_iklan');
        Schema::drop('conf_official_email');
        Schema::drop('conf_grade_member');
    }
}
