<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
	protected $table = 'conf_subdistrict';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'subdistrict_province_id', 'subdistrict_province_name', 'subdistrict_city_id', 'subdistrict_city_name', 'subdistrict_city_type', 'subdistrict_name', 'subdistrict_lat', 'subdistrict_lng'
	];
}
