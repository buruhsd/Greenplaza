<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk_grosir extends Model
{
	protected $table = 'sys_produk_grosir';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'produk_grosir_produk_id', 'produk_grosir_start', 'produk_grosir_end', 'produk_grosir_price', 'produk_grosir_status', 'produk_grosir_note', 'produk_grosir_is_admin', 
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
