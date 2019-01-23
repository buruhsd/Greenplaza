<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLogWallet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_wallet', function($table) {
            $table->decimal('wallet_ballance_after',20,2)->default(0.00)->after('wallet_ballance_before');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_wallet', function($table) {
            $table->dropColumn('wallet_ballance_after');
        });
    }
}
