<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk_image extends Model
{
	protected $table = 'sys_produk_image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'produk_image_produk_id', 'produk_image_image'
    ];

    /**
    * @param
    * @return
    * 
    */
    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'produk_grosir_produk_id');
    }
}
