<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Official_email extends Model
{
    protected $table = 'conf_official_email';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'official_email_email', 
		'official_email_note'
	];
}
