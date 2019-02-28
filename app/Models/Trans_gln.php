<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans_gln extends Model
{
	protected $table = 'sys_trans_gln';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['trans_gln_trans_id', 'trans_gln_detail_id', 'trans_gln_amount', 'trans_gln_amount_fee', 'trans_gln_amount_total', 'trans_gln_compare', 'trans_gln_status', 'trans_gln_note'
    ];

    /**
    * @param
    * @return
    * 
    */
    public function trans()
    {
        return $this->belongsTo('App\Models\Trans', 'trans_gln_trans_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function trans_detail()
    {
        return $this->belongsTo('App\Models\Trans_detail', 'trans_gln_detail_id');
    }
}
