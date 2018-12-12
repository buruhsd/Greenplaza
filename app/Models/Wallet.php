<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'sys_wallet';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wallet_user_id', 'wallet_type', 'wallet_ballance', 'wallet_address', 'wallet_public', 'wallet_private', 'wallet_note'
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
    public function role_user()
    {
        return $this->belongsTo('App\User', 'wallet_user_id');
    }
}
