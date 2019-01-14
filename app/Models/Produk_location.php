<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk_location extends Model
{
	protected $table = 'conf_produk_location';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'produk_location_name', 'produk_location_status', 'produk_location_note', 
    ];
}
