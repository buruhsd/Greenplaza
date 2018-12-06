<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $table = 'sys_withdrawal';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'withdrawal_user_id', 'withdrawal_wallet_id', 'withdrawal_wallet_type', 'withdrawal_wallet_amount', 'withdrawal_status', 'withdrawal_approval_id', 'withdrawal_response_date', 'withdrawal_response_text' 
	];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'withdrawal_user_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function wallet()
    {
        return $this->belongsTo('App\Models\Wallet', 'wallet_user_id');
    }
}
