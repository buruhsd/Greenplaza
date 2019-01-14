<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conf_komplain extends Model
{
    protected $table = 'conf_komplain';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'komplain_name', 'komplain_status', 'komplain_note'];
}
