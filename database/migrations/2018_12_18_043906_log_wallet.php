<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogWallet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('log_wallet');
        Schema::create('log_wallet', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wallet_type_log')->default('manual')->comment('pembuatan log by');
            $table->tinyInteger('wallet_type')->default(0)->comment('mengambil dari conf_wallet_type');
            $table->integer('wallet_user_id')->unsigned()->default(0)->comment('');
            $table->string('wallet_user_name')->nullable()->comment('name user');
            $table->decimal('wallet_ballance_before', 20, 2)->default(0.00)->comment('wallet before');
            $table->decimal('wallet_ballance', 20, 2)->default(0.00)->comment('wallet after');
            $table->decimal('wallet_cash_in', 20, 2)->default(0.00)->comment('wallet masuk (+)');
            $table->decimal('wallet_cash_out', 20, 2)->default(0.00)->comment('wallet keluar (-)');
            $table->integer('wallet_user_from')->unsigned()->default(0)->comment('user penghubung');
            $table->string('wallet_user_from_name')->nullable()->comment('name from user');
            $table->text('wallet_note')->comment('keterangan log');
            $table->decimal('wallet_pajak')->default(0.00)->comment('');
            $table->integer('wallet_id_grade_pajak')->unsigned()->default(0)->comment('');
            $table->integer('wallet_id_referensi')->unsigned()->default(0)->comment('');
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
        Schema::drop('log_wallet');
    }
}
