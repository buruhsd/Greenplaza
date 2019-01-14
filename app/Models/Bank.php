<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
	protected $table = 'conf_bank';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bank_kode', 'bank_name', 'bank_status', 'bank_note',
    ];
}
