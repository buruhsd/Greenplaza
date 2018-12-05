<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserWallet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Province
        Schema::dropIfExists('conf_wallet_type');
        Schema::create('conf_wallet_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wallet_type_kode');
            $table->string('wallet_type_name');
            $table->text('wallet_type_note')->nullable();
            $table->timestamps();
        });

        // Province
        Schema::dropIfExists('sys_wallet');
        Schema::create('sys_wallet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wallet_user_id')->unsigned();
            $table->tinyInteger('wallet_type')->nullable()->comment('mengambil dari conf_wallet_type');
            $table->string('wallet_ballance')->nullable();
            $table->string('wallet_address')->nullable();
            $table->string('wallet_public')->nullable();
            $table->string('wallet_private')->nullable();
            $table->text('wallet_note')->nullable();
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
        Schema::dropIfExists('sys_wallet');
        Schema::dropIfExists('conf_wallet_type');
    }
}
