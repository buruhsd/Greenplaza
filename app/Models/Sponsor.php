<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
	protected $table = 'sys_user_tree';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_tree_user_id', 'user_tree_sponsor_id'
    ];
}
