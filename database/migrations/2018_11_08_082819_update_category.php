<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_category', function($table) {
            $table->string('category_icon')->after('category_name');
            $table->string('category_slug')->after('category_icon');
            $table->string('category_image')->after('category_slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_category', function($table) {
            $table->dropColumn('category_slug');
            $table->dropColumn('category_icon');
            $table->dropColumn('category_image');
        });
    }
}
