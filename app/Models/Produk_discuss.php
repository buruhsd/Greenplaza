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
}
