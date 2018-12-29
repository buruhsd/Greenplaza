<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OtherTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('conf_paket_iklan');
        Schema::create('conf_paket_iklan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paket_iklan_name')->comment('nama paket');
            $table->decimal('paket_iklan_price', 20, 2)->comment('harga paket');
            $table->decimal('paket_iklan_amount', 20, 2)->comment('jumlah paket yang didapat');
            $table->decimal('paket_iklan_bonus', 5, 2)->comment('bonus % pembelian paket');
            $table->timestamps();
        });
        Schema::dropIfExists('conf_paket_hotlist');
        Schema::create('conf_paket_hotlist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paket_hotlist_name')->comment('nama paket');
            $table->decimal('paket_hotlist_price', 20, 2)->comment('harga paket');
            $table->decimal('paket_hotlist_amount', 20, 2)->comment('jumlah paket yang didapat');
            $table->decimal('paket_hotlist_bonus', 5, 2)->comment('bonus % pembelian paket');
            $table->timestamps();
        });
        Schema::dropIfExists('conf_paket_pincode');
        Schema::create('conf_paket_pincode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('paket_pincode_name')->comment('nama paket');
            $table->decimal('paket_pincode_price', 20, 2)->comment('harga paket');
            $table->decimal('paket_pincode_amount', 20, 2)->comment('jumlah paket yang didapat');
            $table->decimal('paket_pincode_bonus', 5, 2)->comment('bonus % pembelian paket');
            $table->timestamps();
        });
        Schema::dropIfExists('sys_trans_iklan');
        Schema::create('sys_trans_iklan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trans_iklan_code');
            $table->integer('trans_iklan_user_id')->unsigned()->comment('id user');
            $table->integer('trans_iklan_paket_id')->unsigned()->comment('id paket');
            $table->integer('trans_iklan_bank_id')->unsigned()->comment('id bank');
            $table->tinyInteger('trans_iklan_status')->default(0)->comment('status, 0.baru, 1.konfirmasi(paid), 2.batal, 3.approve admin, 4.ditolak');
            $table->integer('trans_iklan_payment_id')->default(0)->nullable()->unsigned()->comment('metode pembayaran');
            $table->string('trans_iklan_paid_image')->default('-');
            $table->dateTime('trans_iklan_paid_date')->nullable();
            $table->decimal('trans_iklan_amount', 20, 2)->default(0.00)->comment('amount total');
            $table->integer('trans_iklan_user_response')->default(0)->unsigned()->nullable()->comment('id user');
            $table->dateTime('trans_iklan_date_response')->nullable();
            $table->text('trans_iklan_response_note')->nullable();
            $table->text('trans_iklan_note');
            $table->timestamps();
        });
        Schema::dropIfExists('sys_trans_pincode');
        Schema::create('sys_trans_pincode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trans_pincode_code');
            $table->integer('trans_pincode_user_id')->unsigned()->comment('id user');
            $table->integer('trans_pincode_paket_id')->unsigned()->comment('id paket');
            $table->integer('trans_pincode_bank_id')->unsigned()->comment('id bank');
            $table->tinyInteger('trans_pincode_status')->default(0)->comment('status, 1.baru, 2.konfirmasi(paid), 3.approve admin, 4.ditolak');
            $table->integer('trans_pincode_payment_id')->default(0)->nullable()->unsigned()->comment('metode pembayaran');
            $table->string('trans_pincode_paid_image')->default('-');
            $table->dateTime('trans_pincode_paid_date')->nullable();
            $table->decimal('trans_pincode_amount', 20, 2)->default(0.00)->comment('amount total');
            $table->integer('trans_pincode_user_response')->default(0)->unsigned()->nullable()->comment('id user');
            $table->dateTime('trans_pincode_date_response')->nullable();
            $table->text('trans_pincode_response_note')->nullable();
            $table->text('trans_pincode_note');
            $table->timestamps();
        });
        Schema::dropIfExists('sys_trans_hotlist');
        Schema::create('sys_trans_hotlist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trans_hotlist_code');
            $table->integer('trans_hotlist_user_id')->unsigned()->comment('id user');
            $table->integer('trans_hotlist_paket_id')->unsigned()->comment('id paket');
            $table->integer('trans_hotlist_bank_id')->unsigned()->comment('id bank');
            $table->tinyInteger('trans_hotlist_status')->default(0)->comment('status, 1.baru, 2.konfirmasi(paid), 3.approve admin, 4.ditolak');
            $table->integer('trans_hotlist_payment_id')->default(0)->nullable()->unsigned()->comment('metode pembayaran');
            $table->string('trans_hotlist_paid_image')->default('-');
            $table->dateTime('trans_hotlist_paid_date')->nullable();
            $table->decimal('trans_hotlist_amount', 20, 2)->default(0.00)->comment('amount total');
            $table->integer('trans_hotlist_user_response')->default(0)->unsigned()->nullable()->comment('id user');
            $table->dateTime('trans_hotlist_date_response')->nullable();
            $table->text('trans_hotlist_response_note')->nullable();
            $table->text('trans_hotlist_note');
            $table->timestamps();
        });
        Schema::dropIfExists('log_activity');
        Schema::create('log_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_user_id')->unsigned()->comment('id user');
            $table->integer('activity_status')->default(0);
            $table->string('activity_type_log')->default('manual')->comment('pembuatan log by');
            $table->dateTime('activity_date')->nullable();
            $table->text('activity_note')->nullable();
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
        Schema::drop('log_activity');
        Schema::drop('sys_trans_hotlist');
        Schema::drop('sys_trans_pincode');
        Schema::drop('sys_trans_iklan');
        Schema::drop('conf_paket_pincode');
        Schema::drop('conf_paket_hotlist');
        Schema::drop('conf_paket_iklan');
    }
}
