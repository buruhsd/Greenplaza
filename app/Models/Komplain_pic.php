<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komplain_pic extends Model
{
	protected $table = 'sys_komplain_pic';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'komplain_pic_komplain_id', 'komplain_pic_image'];

    /**
    * @param
    * @return
    * 
    */
    public function komplain()
    {
        return $this->belongsTo('App\Models\Komplain', '');
    }

    /**
    * @param
    * @return
    * 
    */
    public function trans_detail()
    {
        return $this->belongsTo('App\Models\Trans_detail', '');
    }
}
