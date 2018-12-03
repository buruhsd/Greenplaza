<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	protected $table = 'conf_city';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'city_province_id', 'city_province_name', 'city_name', 'city_type', 'city_postal_code', 'city_lat', 'city_lng'
	];
}
