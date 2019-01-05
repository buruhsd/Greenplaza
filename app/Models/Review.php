<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $table = 'sys_review';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['review_produk_id', 'review_user_id', 'review_status', 'review_text'];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'review_user_id');
    }

    public function userdetail()
    {
        return $this->hasOne('App\Models\User_detail', 'user_detail_user_id', 'review_user_id');
    }
	
    /**
    * @param
    * @return
    * 
    */
    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'review_produk_id');
    }
}
