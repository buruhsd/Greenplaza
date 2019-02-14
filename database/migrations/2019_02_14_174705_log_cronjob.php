<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogCronjob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('log_cron_job');
        Schema::create('log_cron_job', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cron_job_method')->comment('perintah cron');
            $table->string('cron_job_type')->comment('start,process,end');
            $table->tinyInteger('cron_job_status')->default(0);
            $table->string('cron_job_title')->nullable();
            $table->text('cron_job_note')->nullable();
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
        Schema::drop('log_cron_job');
    }
}
