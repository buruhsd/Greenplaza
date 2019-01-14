<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
	protected $table = 'conf_shipment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'shipment_parent_id', 'shipment_name', 'shipment_is_usable', 'shipment_status', 'shipment_note', 
	];
}
