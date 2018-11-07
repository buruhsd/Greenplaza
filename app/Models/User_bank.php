<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_bank extends Model
{
	protected $table = 'sys_user_bank';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'user_bank_user_id', 'user_bank_bank_id', 'user_bank_name', 'user_bank_owner', 'user_bank_no', 'user_bank_status', 'user_bank_note', 
    ];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_detail_user_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function Bank()
    {
        return $this->belongsTo('App\Models\Bank', 'user_bank_bank_id');
    }
}
