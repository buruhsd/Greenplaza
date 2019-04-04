<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransSellerNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_trans', function ($table) {
            $table->text('trans_seller_note')->nullable()->after('trans_is_review')->comment('note ke seller');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_trans', function ($table) {
            $table->dropColumn('trans_seller_note');
        });
    }
}
