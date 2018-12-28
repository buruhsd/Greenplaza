<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PincodeAndHotlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_user_detail', function($table) {
            $table->string('user_detail_ktp')->default(0)->after('user_detail_image');
        });
        Schema::table('sys_produk', function($table) {
            $table->integer('produk_hotlist')->default(0)->after('produk_is_hot');
        });
        Schema::dropIfExists('sys_pincode');
        Schema::create('sys_pincode', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pincode_pincode_id')->unsigned()->comment('id pincode');
            $table->integer('pincode_user_id')->unsigned()->comment('id user');
            $table->integer('pincode_iklan_id')->default(0)->unsigned()->comment('id iklan');
            $table->dateTime('pincode_use')->default('0000-00-00 00:00:00')->comment('tanggal dipakai');
            $table->dateTime('pincode_done')->default('0000-00-00 00:00:00')->comment('tanggal selesai');
            $table->text('pincode_note')->comment('keterangan');
            $table->timestamps();
            $table->foreign('pincode_pincode_id')
                ->references('id')
                ->on('sys_trans_pincode')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('pincode_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('pincode_iklan_id')
                ->references('id')
                ->on('sys_iklan')
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
        Schema::drop('sys_pincode');
        Schema::table('sys_produk', function($table) {
            $table->dropColumn('produk_hotlist');
        });
        Schema::table('sys_user_detail', function($table) {
            $table->dropColumn('user_detail_ktp');
        });
    }
}
