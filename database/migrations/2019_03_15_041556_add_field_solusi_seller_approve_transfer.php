<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSolusiSellerApproveTransfer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('sys_solusi', function ($table) {
            $table->tinyInteger('solusi_buyer_without_resi')->defailt(0)->after('solusi_buyer_date');
            $table->tinyInteger('solusi_seller_without_resi')->defailt(0)->after('solusi_seller_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('sys_solusi', function ($table) {
            $table->dropColumn('solusi_seller_without_resi');
            $table->dropColumn('solusi_buyer_without_resi');
        });
    }
}
