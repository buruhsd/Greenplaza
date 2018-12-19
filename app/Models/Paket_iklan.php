<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket_iklan extends Model
{
	protected $table = 'conf_paket_iklan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['paket_iklan_name', 'paket_iklan_price', 'paket_iklan_amount', 'paket_iklan_bonus'];

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
