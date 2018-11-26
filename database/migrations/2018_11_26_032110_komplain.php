<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Komplain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sys_komplain_pic');
        Schema::dropIfExists('sys_komplain_discuss');
        Schema::dropIfExists('sys_solusi');
        Schema::dropIfExists('sys_komplain');
        Schema::dropIfExists('conf_solusi');
        Schema::dropIfExists('conf_komplain');
        // config komplain
        Schema::create('conf_komplain', function (Blueprint $table) {
            $table->increments('id');
            $table->string('komplain_name');
            $table->tinyInteger('komplain_status')->default(0)->comment('0.not active, 1.active');
            $table->text('komplain_note')->nullable();
            $table->timestamps();
        });
        // config solusi
        Schema::create('conf_solusi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('solusi_name');
            $table->tinyInteger('solusi_status')->default(0)->comment('0.not active, 1.active');
            $table->text('solusi_note')->nullable();
            $table->timestamps();
        });
        // trans komplain
        Schema::create('sys_komplain', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('komplain_trans_id')->unsigned()->comment('id transaksi pembeli #sys_trans_detail');
            $table->integer('komplain_komplain_id')->unsigned()->comment('id komplain #conf_komplain');
            $table->tinyInteger('komplain_status')->default(1)->comment('1.proses, 2.help, 3.done');
            $table->dateTime('komplain_clear_date')->nullable();
            $table->timestamps();
            $table->foreign('komplain_trans_id')
                ->references('id')
                ->on('sys_trans_detail')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('komplain_komplain_id')
                ->references('id')
                ->on('conf_komplain')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        // trans solusi
        Schema::create('sys_solusi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solusi_komplain_id')->unsigned()->comment('id komplain pembeli #sys_komplain');
            $table->integer('solusi_solusi_id')->unsigned()->comment('id solusi #conf_solusi');
            $table->integer('solusi_user_id')->unsigned()->comment('id user');
            $table->string('solusi_value')->nullable()->comment('#refund, dll');
            $table->tinyInteger('solusi_status')->default(1)->comment('1.new, 2.process, 3.done');
            $table->string('solusi_buyer_resi')->nullable();
            $table->string('solusi_buyer_shipment')->nullable();
            $table->tinyInteger('solusi_buyer_accept')->default(0)->comment('0.wait, 1.accept');
            $table->dateTime('solusi_buyer_date')->nullable();
            $table->string('solusi_seller_resi')->nullable();
            $table->string('solusi_seller_shipment')->nullable();
            $table->tinyInteger('solusi_seller_accept')->default(0)->comment('0.wait, 1.accept');
            $table->dateTime('solusi_seller_date')->nullable();
            $table->text('solusi_note')->nullable();
            $table->timestamps();
            $table->foreign('solusi_komplain_id')
                ->references('id')
                ->on('sys_komplain')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('solusi_solusi_id')
                ->references('id')
                ->on('conf_solusi')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('solusi_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        // trans komplain diskusi
        Schema::create('sys_komplain_discuss', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('komplain_discuss_komplain_id')->unsigned()->comment('id komplain pembeli #sys_komplain');
            $table->integer('komplain_discuss_user_id')->unsigned()->comment('id user');
            $table->text('komplain_discuss_text');
            $table->timestamps();
            $table->foreign('komplain_discuss_komplain_id')
                ->references('id')
                ->on('sys_komplain')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('komplain_discuss_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
        // trans komplain gambar
        Schema::create('sys_komplain_pic', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('komplain_pic_komplain_id')->unsigned()->comment('id komplain pembeli #sys_komplain');
            $table->string('komplain_pic_image');
            $table->timestamps();
            $table->foreign('komplain_pic_komplain_id')
                ->references('id')
                ->on('sys_komplain')
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
        Schema::dropIfExists('sys_komplain_pic');
        Schema::dropIfExists('sys_komplain_discuss');
        Schema::dropIfExists('sys_solusi');
        Schema::dropIfExists('sys_komplain');
        Schema::dropIfExists('conf_komplain');
        Schema::dropIfExists('conf_solusi');
    }
}
