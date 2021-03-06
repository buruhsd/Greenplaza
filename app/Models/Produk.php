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
		'produk_seller_id','produk_category_id','produk_brand_id','produk_name','produk_slug','produk_unit','produk_price','price_idr','produk_size','produk_length','produk_wide','produk_height','produk_color','produk_stock','produk_weight','produk_discount','produk_location','produk_image','produk_viewer','produk_status','produk_user_status','produk_is_best','produk_is_hot', 'produk_hotlist','produk_note',
    ];

    /**
    * @param
    * @return
    * 
    */
    public function user_detail()
    {
        return $this->belongsTo('App\Models\User_detail', 'produk_seller_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'produk_seller_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function userWithAddress()
    {
        return $this->belongsTo('App\User', 'produk_seller_id')->user_address();
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
        return $this->belongsTo('App\Models\Produk_unit', 'produk_unit');
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
    * 
    * 
    **/
    public function is_grosir(){
        return (bool)$this->grosir->count();
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

    /**
    * @param
    * @return
    * 
    */
    public function images()
    {
        return $this->hasMany('App\Models\Produk_image', 'produk_image_produk_id');
    }
    public function review()
    {
        return $this->hasMany('App\Models\Review', 'review_produk_id');
    }
    public function avg_star()
    {
        return $this->review()->avg('review_stars');
    }
    public function avg_star_field()
    {
        return $this->hasMany('App\Models\Review', 'review_produk_id')
                ->selectRaw('review_produk_id,AVG(sys_review.review_stars) AS average_rating')
                ->groupBy('review_produk_id');
    }

    public function count_review($data){
        return Review::where('review_produk_id',$data->id)->count();
    }

    public function count_discuss($data){
        return Produk_discuss::where('produk_discuss_produk_id',$data->id)->count();
    }

    /**
    * @param
    * @return
    * 
    */
    public function trans_detail()
    {
        return $this->hasMany('App\Models\Trans_detail', 'trans_detail_produk_id');
    }
}
