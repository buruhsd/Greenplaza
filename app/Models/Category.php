<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'sys_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_parent_id', 'category_name', 'category_icon','category_slug', 'category_status', 'category_note',
    ];

    /**
    * @param
    * @return
    * 
    */
    public function par()
    {
        return $this->belongsTo('App\Models\Category', 'category_parent_id');
    }
}
