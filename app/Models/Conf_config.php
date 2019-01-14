<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conf_config extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'configs_name', 'configs_value', 'configs_status', 'configs_note',
    ];
}
