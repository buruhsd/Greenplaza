<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_wallet extends Model
{
	protected $table = 'log_wallet';
    protected $primaryKey = 'wallet_user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'wallet_type_log', 'wallet_type', 'wallet_user_id', 'wallet_user_name', 'wallet_ballance_before', 'wallet_ballance_after', 'wallet_cash_in', 'wallet_cash_out', 'wallet_user_from', 'wallet_user_from_name', 'wallet_note', 'wallet_pajak', 'wallet_id_grade_pajak', 'wallet_id_referensi'
    ];

    /**
    * @param
    * @return
    * 
    */
    public function type()
    {
        return $this->belongsTo('App\Models\Wallet_type', 'wallet_type');
    }

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'wallet_user_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function from()
    {
        return $this->belongsTo('App\User', 'wallet_user_from');
    }

    /**
    * @param
    * @return
    * 
    */
    public function wallet()
    {
        return $this->belongsTo('App\Models\Wallet', 'wallet_user_id', 'wallet_user_id')->where('wallet_type', $this->wallet_type);
    }
}
