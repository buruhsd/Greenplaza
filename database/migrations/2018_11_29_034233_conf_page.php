<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('conf_page');
        // trans komplain
        Schema::create('conf_page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page_judul')->comment('');
            $table->integer('page_role_id')->unsigned()->default(0)->nullable()->comment('title page menu');
            $table->string('page_kategori')->comment('title page menu');
            $table->text('page_text')->comment('content page');
            $table->tinyInteger('page_status')->default(1)->comment('status page 0.non active, 1.active');
            $table->string('page_slug')->comment('');
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
        Schema::dropIfExists('conf_page');
    }
}
