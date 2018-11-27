<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk_discuss extends Model
{
	protected $table = 'sys_produk_discuss';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'produk_discuss_produk_id', 'produk_discuss_user_id', 'produk_discuss_text', 'produk_discuss_status', 'produk_discuss_read_member', 'produk_discuss_read_seller', 
	];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'produk_discuss_user_id');
    }
	
    /**
    * @param
    * @return
    * 
    */
    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'produk_discuss_produk_id');
    }
	
    /**
    * @param
    * @return
    * 
    */
    public function reply()
    {
        return $this->hasMany('App\Models\Produk_discuss_reply', 'produk_discuss_reply_discuss_id');
    }
}
