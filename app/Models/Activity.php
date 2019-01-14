<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	protected $table = 'log_activity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['activity_user_id', 'activity_status', 'activity_type_log', 'activity_date', 'activity_note'];

    /**
    * @param
    * @return
    * 
    */
    public function seller()
    {
        return $this->belongsTo('App\User', 'brand_seller_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function admin()
    {
        return $this->belongsTo('App\User', 'brand_admin_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function superadmin()
    {
        return $this->belongsTo('App\User', 'brand_superadmin_id');
    }
}
