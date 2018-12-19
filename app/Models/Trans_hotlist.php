<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans_hotlist extends Model
{
	protected $table = 'sys_trans_hotlist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trans_hotlist_code', 'trans_hotlist_user_id', 'trans_hotlist_paket_id', 'trans_hotlist_bank_id', 'trans_hotlist_status', 'trans_hotlist_payment_id', 'trans_hotlist_paid_image', 'trans_hotlist_paid_date', 'trans_hotlist_amount', 'trans_hotlist_user_response', 'trans_hotlist_date_response', 'trans_hotlist_response_note', 'trans_hotlist_note'
    ];

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
