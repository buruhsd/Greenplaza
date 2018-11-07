<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_address extends Model
{
	protected $table = 'sys_user_address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'user_address_user_id', 'user_address_label', 'user_address_owner', 'user_address_address', 'user_address_phone', 'user_address_tlp', 'user_address_province', 'user_address_city', 'user_address_subdist', 'user_address_pos', 'user_address_status', 'user_address_note', 
    ];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_address_user_id');
    }
}