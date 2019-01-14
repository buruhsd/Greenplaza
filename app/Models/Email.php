<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
	protected $table = 'sys_email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email_to', 'email_from', 'email_subject', 'email_type', 'email_text', 'is_send', 'is_send_datetime'];
}
