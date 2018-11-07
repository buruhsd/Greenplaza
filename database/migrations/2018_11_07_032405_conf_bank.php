<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_bank', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bank_kode');
            $table->string('bank_name');
            $table->tinyInteger('bank_status')->default(1);
            $table->text('bank_note')->nullable();
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
        Schema::dropIfExists('conf_bank');
    }
}
