<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_shipment extends Model
{
	protected $table = 'sys_user_shipment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_shipment_user_id', 'user_shipment_shipment_id', 'user_shipment_name'];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_address_user_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function shipment()
    {
        return $this->belongsTo('App\Models\Shipment', 'user_shipment_shipment_id');
    }
}