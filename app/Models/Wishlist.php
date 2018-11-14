<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
	protected $table = 'sys_wishlist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'wishlist_produk_id', 'wishlist_user_id', 'wishlist_note', 
	];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'wishlist_user_id');
    }
	
    /**
    * @param
    * @return
    * 
    */
    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'wishlist_produk_id');
    }
}
