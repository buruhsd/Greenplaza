<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // satuan unit
        Schema::create('conf_produk_unit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('produk_unit_name');
            $table->tinyInteger('produk_unit_status')->default(1);
            $table->text('produk_unit_note')->nullable();
            $table->timestamps();
        });
        // lokasi produk
        Schema::create('conf_produk_location', function (Blueprint $table) {
            $table->increments('id');
            $table->string('produk_location_name');
            $table->tinyInteger('produk_location_status')->default(1);
            $table->text('produk_location_note')->nullable();
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
        Schema::drop('conf_produk_unit');
        Schema::drop('conf_produk_location');
    }
}
