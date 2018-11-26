<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komplain_discuss extends Model
{
	protected $table = 'sys_komplain_discuss';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'komplain_discuss_komplain_id', 'komplain_discuss_user_id', 'komplain_discuss_text'];

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
