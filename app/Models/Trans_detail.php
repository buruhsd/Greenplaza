<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans_detail extends Model
{
	protected $table = 'sys_trans_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'trans_detail_code', 'trans_detail_trans_id', 'trans_detail_produk_id', 'trans_detail_shipment_id', 'trans_detail_shipment_service', 'trans_detail_user_address_id', 'trans_detail_no_resi', 'trans_detail_qty', 'trans_detail_size', 'trans_detail_color', 'trans_detail_amount', 'trans_detail_amount_ship', 'trans_detail_amount_total', 'trans_detail_status', 'trans_detail_transfer', 'trans_detail_transfer_date', 'trans_detail_transfer_note', 'trans_detail_able', 'trans_detail_able_date', 'trans_detail_able_note', 'trans_detail_packing', 'trans_detail_packing_date', 'trans_detail_packing_note', 'trans_detail_send', 'trans_detail_send_date', 'trans_detail_send_note', 'trans_detail_drop', 'trans_detail_drop_date', 'trans_detail_drop_note', 'trans_detail_note', 
	];

    /**
    * check jika transaksi mempunyai komplain
    **/
    public function is_komplain(){
        if($this->komplain !== null){
            return (bool)$this->komplain->count();
        }
        return false;
    }

    /**
    * @param
    * @return
    * 
    */
    public function gln()
    {
        return $this->hasOne('App\Models\Trans_gln', 'trans_gln_detail_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function trans()
    {
        return $this->belongsTo('App\Models\Trans', 'trans_detail_trans_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'trans_detail_produk_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function shipment()
    {
        return $this->belongsTo('App\Models\Shipment', 'trans_detail_shipment_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function user_address()
    {
        return $this->belongsTo('App\Models\User_address', 'trans_detail_user_address_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function komplain()
    {
        return $this->hasOne('App\Models\Komplain', 'komplain_trans_id');
    }
}
