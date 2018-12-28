<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
    protected $table = 'sys_iklan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'iklan_iklan_id', 
		'iklan_user_id', 
		'iklan_title', 
		'iklan_image', 
		'iklan_status', 
		'iklan_category_id', 
		'iklan_link', 
		'iklan_use', 
		'iklan_done', 
		'iklan_content'
		'iklan_note'
	];

    /**
    * @param
    * @return
    * 
    */
    public function jenis()
    {
        return $this->belongsTo('App\Models\Conf_iklan', 'iklan_iklan_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'iklan_category_id');
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
