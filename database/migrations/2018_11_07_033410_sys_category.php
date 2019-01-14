<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sys_category');
        Schema::create('sys_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_parent_id')->unsigned();
            $table->string('category_name');
            $table->tinyInteger('category_status')->default(1);
            $table->text('category_note')->nullable();
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
        Schema::drop('sys_category');
    }
}
