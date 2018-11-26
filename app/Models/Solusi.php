<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
	protected $table = 'sys_solusi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'solusi_komplain_id', 'solusi_solusi_id', 'solusi_user_id', 'solusi_value', 'solusi_status', 'solusi_buyer_resi', 'solusi_buyer_shipment', 'solusi_buyer_accept', 'solusi_buyer_date', 'solusi_seller_resi', 'solusi_seller_shipment', 'solusi_seller_accept', 'solusi_seller_date', 'solusi_note'];

    /**
    * @param
    * @return
    * 
    */
    public function komplain()
    {
        return $this->belongsTo('App\Komplain', 'solusi_komplain_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function solusi_type()
    {
        return $this->belongsTo('App\Conf_solusi', 'solusi_solusi_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'solusi_user_id');
    }
}
