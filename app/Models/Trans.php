<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans extends Model
{
	protected $table = 'sys_trans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'trans_code', 'trans_qr', 'trans_user_id', 'trans_user_bank_id', 'trans_is_paid', 'trans_payment_id', 'trans_paid_image', 'trans_paid_date', 'trans_paid_note', 'trans_amount', 'trans_amount_ship', 'trans_amount_total', 'trans_note', 
	];

    /**
    * 
    * 
    **/
    public function masedi(){
        if((bool)$this->trans_payment_id == 3 && 
            (bool)$this->trans_qr && 
            (bool)$this->trans_qr !== null && 
            (bool)$this->trans_qr !== ""){
            
            return true;
        }
        return false;
    }

    /**
    * @param
    * @return
    * 
    */
    public function trans_gln()
    {
        return $this->hasMany('App\Models\Trans_gln', 'trans_gln_trans_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function trans_detail()
    {
        return $this->hasMany('App\Models\Trans_detail', 'trans_detail_trans_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function trans_detailCount()
    {
        return $this->hasOne('App\Models\Trans_detail', 'trans_detail_trans_id')
        	->selectRaw('trans_detail_trans_id, count(*) as aggregate')
    		->groupBy('trans_detail_trans_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function pembeli()
    {
        return $this->belongsTo('App\User', 'trans_user_id');
    }
}
