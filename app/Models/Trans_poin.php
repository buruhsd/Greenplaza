<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans_poin extends Model
{
	protected $table = 'sys_trans_poin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trans_poin_trans_id', 'trans_poin_persen', 'trans_poin_compare', 'trans_poin_poin_total', 'trans_poin_total', 'trans_poin_status', 'trans_poin_note'
    ];

    /**
    * @param
    * @return
    * 
    */
    public function trans()
    {
        return $this->belongsTo('App\Models\Trans', 'trans_poin_trans_id');
    }
}
