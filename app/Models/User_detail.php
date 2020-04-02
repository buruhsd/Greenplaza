<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    protected $table = 'sys_user_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_detail_user_id', 'user_detail_pass_trx', 'user_detail_jk','user_detail_token','user_detail_address','user_detail_phone','user_detail_tlp','user_detail_province','user_detail_city','user_detail_subdist','user_detail_pos','user_detail_image', 'user_detail_ktp','user_detail_bank_id','user_detail_bank_name','user_detail_bank_owner','user_detail_bank_no','user_detail_status','user_detail_note', 'country_id',
    ];

    protected $appends = ['profil_img'];

    /**
    * @param
    * @return
    * 
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_detail_user_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }
    
    public function getProfilImgAttribute()
    {
        // $asset_toko = asset('assets/images/bg_etalase');
        return asset('assets/images/profil/'.$this->user_detail_image);
    }
}
