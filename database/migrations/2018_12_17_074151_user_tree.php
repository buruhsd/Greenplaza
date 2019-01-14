<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sys_user_tree');
        Schema::create('sys_user_tree', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_tree_user_id')->unsigned();
            $table->integer('user_tree_sponsor_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_tree_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_tree_sponsor_id')
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
        Schema::drop('sys_user_tree');
    }
}
