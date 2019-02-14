<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_cron_job extends Model
{
	protected $table = 'log_cron_job';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cron_job_method', 'cron_job_type', 'cron_job_status', 'cron_job_title', 'cron_job_note'
    ];
}
