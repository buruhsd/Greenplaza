<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
	protected $table = 'sys_produk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'produk_seller_id','produk_category_id','produk_brand_id','produk_name','produk_slug','produk_unit','produk_price','produk_size','produk_length','produk_wide','produk_color','produk_stock','produk_weight','produk_discount','produk_location','produk_image','produk_viewer','produk_status','produk_user_status','produk_is_best','produk_is_hot','produk_note',
    ];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'produk_seller_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'produk_category_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'produk_brand_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function unit()
    {
        return $this->hasMany('App\Models\Produk_unit', 'produk_unit');
    }

    /**
    * @param
    * @return
    * 
    */
    public function location()
    {
        return $this->hasMany('App\Models\Produk_location', 'produk_location');
    }

    /**
    * @param
    * @return
    * 
    */
    public function grosir()
    {
        return $this->hasMany('App\Models\Produk_grosir', 'produk_grosir_produk_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function wishlist()
    {
        return $this->hasMany('App\Models\Wishlist', 'wishlist_produk_id');
    }
}
