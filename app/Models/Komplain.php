<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
	protected $table = 'sys_komplain';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'komplain_trans_id', 'komplain_komplain_id', 'komplain_status', 'komplain_clear_date'];

    /**
    * @param
    * @return
    * 
    */
    public function komplain_type()
    {
        return $this->belongsTo('App\Models\Conf_komplain', 'komplain_komplain_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function solusi()
    {
        return $this->hasOne('App\Models\Solusi', 'solusi_komplain_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function pic()
    {
        return $this->hasOne('App\Models\Komplain_pic', 'komplain_pic_komplain_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function trans_detail()
    {
        return $this->belongsTo('App\Models\Trans_detail', 'komplain_trans_id');
    }
}
