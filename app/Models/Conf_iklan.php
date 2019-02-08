<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conf_iklan extends Model
{
    protected $table = 'conf_iklan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'iklan_name', 'iklan_price', 'iklan_status', 'iklan_type', 'iklan_note'
	];

    /**
    * @param
    * @return
    * 
    */
    public function iklan()
    {
        return $this->hasMany('App\Models\Iklan', 'iklan_iklan_id');
    }
}
