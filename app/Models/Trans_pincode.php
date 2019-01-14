<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans_pincode extends Model
{
	protected $table = 'sys_trans_pincode';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trans_pincode_code', 'trans_pincode_user_id', 'trans_pincode_paket_id', 'trans_pincode_bank_id', 'trans_pincode_status', 'trans_pincode_payment_id', 'trans_pincode_paid_image', 'trans_pincode_paid_date', 'trans_pincode_amount', 'trans_pincode_user_response', 'trans_pincode_date_response', 'trans_pincode_response_note', 'trans_pincode_note'
    ];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'trans_pincode_user_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function paket()
    {
        return $this->belongsTo('App\Models\Paket_pincode', 'trans_pincode_paket_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function bank()
    {
        return $this->belongsTo('App\Models\User_bank', 'trans_pincode_bank_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment', 'trans_pincode_payment_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function pincode()
    {
        return $this->hasMany('App\Models\Pincode', 'pincode_pincode_id');
    }
}
