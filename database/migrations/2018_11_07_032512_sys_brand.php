<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SysBrand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sys_brand');
        Schema::create('sys_brand', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand_name');
            $table->tinyInteger('brand_status')->default(1);
            $table->tinyInteger('brand_user_status')->default(0);
            $table->integer('brand_seller_id')->nullable()->default(0)->unsigned();
            $table->integer('brand_admin_id')->nullable()->default(0)->unsigned();
            $table->integer('brand_superadmin_id')->nullable()->default(0)->unsigned();
            $table->string('brand_image');
            $table->string('brand_slug');
            $table->text('brand_note')->nullable();
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
        Schema::drop('sys_brand');
    }
}
