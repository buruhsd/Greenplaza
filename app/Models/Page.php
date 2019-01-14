<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	protected $table = 'conf_page';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'page_judul', 'page_role_id', 'page_kategori', 'page_text', 'page_status', 'page_slug'
    ];

    /**
    * @param
    * @return
    * 
    */
    public function Role()
    {
        return $this->belongsTo('App\Role', 'page_role_id');
    }
}
