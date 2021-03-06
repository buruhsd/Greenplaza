<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk_discuss_reply extends Model
{
	protected $table = 'sys_produk_discuss_reply';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'produk_discuss_reply_discuss_id', 'produk_discuss_reply_user_id', 'produk_discuss_reply_text', 'produk_discuss_reply_status', 'produk_discuss_reply_read_member', 'produk_discuss_reply_read_seller', 
	];
	
    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'produk_discuss_reply_user_id');
    }
	
    /**
    * @param
    * @return
    * 
    */
    public function discuss()
    {
        return $this->belongsTo('App\Models\Produk_discuss', 'produk_discuss_reply_discuss_id');
    }
}
