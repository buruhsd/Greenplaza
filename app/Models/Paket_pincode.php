<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket_pincode extends Model
{
	protected $table = 'conf_paket_pincode';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['paket_pincode_name', 'paket_pincode_price', 'paket_pincode_amount', 'paket_pincode_bonus'];

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
