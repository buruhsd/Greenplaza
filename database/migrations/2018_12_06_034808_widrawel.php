<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Widrawel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Province
        Schema::dropIfExists('sys_withdrawal');
        Schema::create('sys_withdrawal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('withdrawal_user_id')->unsigned();
            $table->integer('withdrawal_wallet_id')->unsigned();
            $table->integer('withdrawal_wallet_type')->unsigned()->nullable();
            $table->decimal('withdrawal_wallet_amount', 20, 2)->default(0.00);
            $table->tinyInteger('withdrawal_status')->default(0)->nullable();
            $table->integer('withdrawal_approval_id')->unsigned()->default(0)->nullable();
            $table->datetime('withdrawal_response_date')->nullable();
            $table->text('withdrawal_response_text')->nullable();
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
        Schema::dropIfExists('sys_withdrawal');
    }
}
