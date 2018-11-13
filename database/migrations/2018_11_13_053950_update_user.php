<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('user_store')->nullable()->after('name');
            $table->string('user_slogan')->nullable()->after('user_store');
            $table->string('user_slug')->nullable()->after('user_store')->comment("store url");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('user_store');
            $table->dropColumn('user_slogan');
            $table->dropColumn('user_slug');
        });
    }
}
