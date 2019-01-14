<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysTrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // metode pembayaran
        Schema::dropIfExists('sys_trans_detail');
        Schema::dropIfExists('conf_shipment');
        Schema::dropIfExists('sys_trans');
        Schema::dropIfExists('conf_payment');
        Schema::create('conf_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_kode');
            $table->string('payment_name');
            $table->tinyInteger('payment_status')->default(1)->comment('1.aktif');
            $table->text('payment_note')->nullable();
            $table->timestamps();
        });

        // Transaksi
        Schema::create('sys_trans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trans_code');
            $table->integer('trans_user_id')->unsigned();
            $table->integer('trans_user_bank_id')->unsigned();
            $table->tinyInteger('trans_is_paid')->default(0)->comment('status transfer, 1.sudah di tf, 2.diterima admin');
            $table->integer('trans_payment_id')->default(0)->nullable()->unsigned()->comment('metode pembayaran');
            $table->string('trans_paid_image')->default('-');
            $table->dateTime('trans_paid_date')->nullable();
            $table->text('trans_paid_note')->nullable();
            $table->decimal('trans_amount', 20, 2)->default(0.00);
            $table->decimal('trans_amount_ship', 20, 2)->default(0.00);
            $table->decimal('trans_amount_total', 20, 2)->default(0.00);
            $table->text('trans_note');
            $table->timestamps();
            $table->foreign('trans_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('trans_user_bank_id')
                ->references('id')
                ->on('sys_user_bank')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('trans_payment_id')
                ->references('id')
                ->on('conf_payment')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        // metode pengiriman
        Schema::create('conf_shipment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipment_parent_id')->unsigned();
            $table->string('shipment_name');
            $table->tinyInteger('shipment_is_usable')->default(1);
            $table->tinyInteger('shipment_status')->default(1)->comment('1.aktif');
            $table->text('shipment_note')->nullable();
            $table->timestamps();
        });

        // Detail Transaksi
        Schema::create('sys_trans_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trans_code');
            $table->integer('trans_detail_trans_id')->unsigned();
            $table->integer('trans_detail_produk_id')->unsigned();
            $table->integer('trans_detail_shipment_id')->unsigned();
            $table->integer('trans_detail_user_address_id')->unsigned();
            $table->string('trans_detail_no_resi')->default(0);
            $table->integer('trans_detail_qty');
            $table->string('trans_detail_size');
            $table->string('trans_detail_color', 150);
            $table->decimal('trans_detail_amount', 20, 2)->default(0.00);
            $table->decimal('trans_detail_amount_ship', 20, 2)->default(0.00);
            $table->decimal('trans_detail_amount_total', 20, 2)->default(0.00);
            $table->tinyInteger('trans_detail_status')->default(0)->comment('status, 0.chart 1.order 2.transfer 3.seller 4.packing 5.shipping 6.dropping');
            $table->tinyInteger('trans_detail_transfer')->default(0)->comment('transfer #member approver, 0.menunggu 1.di transfer 2.batal');
            $table->dateTime('trans_detail_transfer_date')->nullable();
            $table->text('trans_detail_transfer_note')->nullable();
            $table->tinyInteger('trans_detail_able')->default(0)->comment('sanggup #seller, 0.menunggu 1.sanggup 2.batal');
            $table->dateTime('trans_detail_able_date')->nullable();
            $table->text('trans_detail_able_note')->nullable();
            $table->tinyInteger('trans_detail_packing')->default(0)->comment('transfer #seller, 0.menunggu 1.di packing 2.batal');
            $table->dateTime('trans_detail_packing_date')->nullable();
            $table->text('trans_detail_packing_note')->nullable();
            $table->tinyInteger('trans_detail_send')->default(0)->comment('dikirim #seller, 0.menunggu 1.dikirim 2.batal');
            $table->dateTime('trans_detail_send_date')->nullable();
            $table->text('trans_detail_send_note')->nullable();
            $table->tinyInteger('trans_detail_drop')->default(0)->comment('diambil #member, 0.menunggu 1.diambil');
            $table->dateTime('trans_detail_drop_date')->nullable();
            $table->text('trans_detail_drop_note')->nullable();
            $table->tinyInteger('trans_detail_is_cancel')->default(0)->comment('1=transaction cancel');
            $table->text('trans_detail_note');
            $table->timestamps();
            $table->foreign('trans_detail_trans_id')
                ->references('id')
                ->on('sys_trans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('trans_detail_produk_id')
                ->references('id')
                ->on('sys_produk')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('trans_detail_shipment_id')
                ->references('id')
                ->on('conf_shipment')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('trans_detail_user_address_id')
                ->references('id')
                ->on('sys_user_address')
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
        Schema::drop('sys_trans_detail');
        Schema::drop('conf_shipment');
        Schema::drop('sys_trans');
        Schema::drop('conf_payment');
    }
}
