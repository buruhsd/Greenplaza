<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_iklan extends Model
{
    protected $table = 'sys_withdrawal';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'iklan_iklan_id', 'iklan_user_id', 'iklan_name', 'iklan_price_before', 'iklan_price_after', 'iklan_username', 'iklan_note'
	];

    /**
    * @param
    * @return
    * 
    */
    public function iklan()
    {
        return $this->belongsTo('App\Models\Iklan', 'iklan_iklan_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'iklan_user_id');
    }
}
