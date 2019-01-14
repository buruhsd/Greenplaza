<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Province
        Schema::dropIfExists('conf_province');
        Schema::create('conf_province', function (Blueprint $table) {
            $table->increments('id');
            $table->string('province_name');
            $table->string('province_lat')->nullable();
            $table->string('province_lng')->nullable();
        });
        // City
        Schema::dropIfExists('conf_city');
        Schema::create('conf_city', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_province_id')->unsigned();
            $table->string('city_province_name');
            $table->string('city_name');
            $table->string('city_type');
            $table->string('city_postal_code');
            $table->string('city_lat')->nullable();
            $table->string('city_lng')->nullable();
        });
        // Subdistrict
        Schema::dropIfExists('conf_subdistrict');
        Schema::create('conf_subdistrict', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subdistrict_province_id')->unsigned();
            $table->string('subdistrict_province_name');
            $table->integer('subdistrict_city_id')->unsigned();
            $table->string('subdistrict_city_name');
            $table->string('subdistrict_city_type');
            $table->string('subdistrict_name');
            $table->string('subdistrict_lat')->nullable();
            $table->string('subdistrict_lng')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conf_province');
        Schema::dropIfExists('conf_city');
        Schema::dropIfExists('conf_subdistrict');
    }
}
