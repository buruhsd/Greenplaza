<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompareGlnField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_trans_gln', function ($table) {
            $table->decimal('trans_gln_compare', 20, 8)->default(0.00)->after('trans_gln_amount_total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_trans_gln', function ($table) {
            $table->dropColumn('trans_gln_compare');
        });
    }
}
