<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    protected $table = 'sys_pincode';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'pincode_code', 'pincode_pincode_id', 'pincode_user_id', 'pincode_iklan_id', 'pincode_use', 'pincode_done', 'pincode_note'
	];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'pincode_user_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function iklan()
    {
        return $this->belongsTo('App\Models\Iklan', 'pincode_iklan_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function pincode()
    {
        return $this->belongsTo('App\Models\Trans_pincode', 'pincode_pincode_id');
    }
}
