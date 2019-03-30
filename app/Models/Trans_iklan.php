<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans_iklan extends Model
{
	protected $table = 'sys_trans_iklan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trans_iklan_code', 'trans_iklan_qr', 'trans_iklan_user_id', 'trans_iklan_paket_id', 'trans_iklan_bank_id', 'trans_iklan_status', 'trans_iklan_payment_id', 'trans_iklan_paid_image', 'trans_iklan_paid_date', 'trans_iklan_amount', 'trans_iklan_user_response', 'trans_iklan_date_response', 'trans_iklan_response_note', 'trans_iklan_note'
    ];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'trans_iklan_user_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function paket()
    {
        return $this->belongsTo('App\Models\Paket_iklan', 'trans_iklan_paket_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function bank()
    {
        return $this->belongsTo('App\Models\User_bank', 'trans_iklan_bank_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment', 'trans_iklan_payment_id');
    }
}
