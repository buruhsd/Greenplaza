<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk_unit extends Model
{
	protected $table = 'conf_produk_unit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'produk_unit_name', 'produk_unit_status', 'produk_unit_note', 
    ];
}
