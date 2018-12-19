<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket_hotlist extends Model
{
	protected $table = 'conf_paket_hotlist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['paket_hotlist_name', 'paket_hotlist_price', 'paket_hotlist_amount', 'paket_hotlist_bonus'];

    /**
    * @param
    * @return
    * 
    */
    public function seller()
    {
        return $this->belongsTo('App\User', 'brand_seller_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function admin()
    {
        return $this->belongsTo('App\User', 'brand_admin_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function superadmin()
    {
        return $this->belongsTo('App\User', 'brand_superadmin_id');
    }
}
