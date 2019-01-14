<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserUpload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_user_detail', function($table) {
            $table->string('user_detail_npwp')->nullable()->after('user_detail_bank_no')->comment("nomor npwp");
            $table->string('user_detail_npwp_image')->nullable()->after('user_detail_npwp')->comment("pic npwp");
            $table->string('user_detail_siup')->nullable()->after('user_detail_npwp_image')->comment("nomor siup");
            $table->string('user_detail_siup_image')->nullable()->after('user_detail_siup')->comment("pic siup");
            $table->string('user_detail_rek_book_image')->nullable()->after('user_detail_siup_image')->comment("pic buku rekening");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_user_detail', function($table) {
            $table->dropColumn('user_detail_rek_book_image');
            $table->dropColumn('user_detail_siup_image');
            $table->dropColumn('user_detail_siup');
            $table->dropColumn('user_detail_npwp_image');
            $table->dropColumn('user_detail_npwp');
        });
    }
}
