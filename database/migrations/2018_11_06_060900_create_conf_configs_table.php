<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('conf_configs');
        Schema::create('conf_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('configs_name');
            $table->text('configs_value');
            $table->tinyInteger('configs_status')->default(1);
            $table->text('configs_note')->nullable();
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
        Schema::drop('conf_configs');
    }
}
