<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conf_solusi extends Model
{
	protected $table = 'conf_solusi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'solusi_name', 'solusi_status', 'solusi_note'];
}
