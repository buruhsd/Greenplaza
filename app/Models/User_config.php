<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
	protected $table = 'sys_user_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'config_user_id', 'config_name', 'config_value', 'config_note'
    ];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'config_user_id');
    }
}
