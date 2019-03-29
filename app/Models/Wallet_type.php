<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet_type extends Model
{
	protected $table = 'conf_wallet_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wallet_type_kode', 'wallet_type_name', 'wallet_type_note'
    ];

    public function log(){
        return $this->hasMany('App\Models\Log_wallet', 'wallet_type');
    }
}
