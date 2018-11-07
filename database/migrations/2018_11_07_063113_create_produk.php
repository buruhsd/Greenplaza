<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_produk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produk_seller_id')->unsigned();
            $table->integer('produk_category_id')->nullable()->unsigned();
            $table->integer('produk_brand_id')->nullable()->unsigned();
            $table->string('produk_name');
            $table->string('produk_slug');
            $table->tinyInteger('produk_unit')->default(0);
            $table->decimal('produk_price', 20, 8);
            $table->string('produk_size');
            $table->decimal('produk_length', 8, 2);
            $table->decimal('produk_wide', 8, 2);
            $table->string('produk_color', 50);
            $table->integer('produk_stock');
            $table->integer('produk_weight');
            $table->decimal('produk_discount', 5, 2);
            $table->tinyInteger('produk_location')->default(1)->comment('lokasi produk');
            $table->string('produk_image')->nullable();
            $table->integer('produk_viewer')->default(0);
            $table->tinyInteger('produk_status')->default(1)->comment('1. aktif, 2. nonaktif');
            $table->tinyInteger('produk_user_status')->default(1)->comment('1. seller, 2. admin, 3. superadmin');
            $table->tinyInteger('produk_is_best')->default(0);
            $table->tinyInteger('produk_is_hot')->default(0);
            $table->text('produk_note')->nullable();
            $table->timestamps();
            $table->foreign('produk_seller_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('produk_category_id')
                ->references('id')
                ->on('sys_category')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('produk_brand_id')
                ->references('id')
                ->on('sys_brand')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
        // satuan unit
        Schema::create('sys_produk_grosir', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produk_grosir_produk_id')->unsigned();
            $table->integer('produk_grosir_start');
            $table->integer('produk_grosir_end');
            $table->decimal('produk_grosir_price', 20, 8);
            $table->tinyInteger('produk_grosir_status')->default(1);
            $table->text('produk_grosir_note')->nullable();
            $table->tinyInteger('produk_grosir_is_admin')->default(0);
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
        Schema::dropIfExists('sys_produk');
        Schema::dropIfExists('sys_produk_grosir');
    }
}
