<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserShipment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sys_user_shipment');
        // shipment user
        Schema::create('sys_user_shipment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_shipment_user_id')->unsigned();
            $table->integer('user_shipment_shipment_id')->default(0)->unsigned();
            $table->string('user_shipment_name');
            $table->timestamps();
            $table->foreign('user_shipment_user_id')
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
        Schema::drop('sys_user_shipment');
    }
}
