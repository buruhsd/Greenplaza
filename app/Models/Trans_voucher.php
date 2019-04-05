<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans_voucher extends Model
{
	protected $table = 'sys_trans_voucher';

    protected $primaryKey = "trans_voucher_trans";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trans_voucher_user', 'trans_voucher_trans', 'trans_voucher_code', 'trans_voucher_amount', 'trans_voucher_status', 'trans_voucher_note'
    ];

    /**
    * @param
    * @return
    * 
    */
    public function trans()
    {
        return $this->hasMany('App\Models\Trans', 'trans_code', 'trans_voucher_trans');
    }
}
