<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * 
    * 
    **/
    public function is_superadmin(){
        return $this->hasRole('superadmin');
    }

    /**
    * 
    * 
    **/
    public function is_admin(){
        return $this->hasRole('admin');
    }

    /**
    * 
    * 
    **/
    public function is_member(){
        return $this->hasRole('member');
    }

    /**
    * 
    * 
    **/
    public function seller_active(){
        if((bool)$this->user_store && (bool)$this->user_store !== null && (bool)$this->user_store !== ""){
            return true;
        }
        return false;
    }

    /**
    * 
    * 
    **/
    public function member_actiive(){
        if($this->have_bank() && $this->have_detail() && $this->have_address()){
            return true;
        }
        return false;
    }

    /**
    * 
    * 
    **/
    public function have_bank(){
        return (bool)$this->user_bank->count();
    }

    /**
    * 
    * 
    **/
    public function have_detail(){
        return (bool)$this->user_detail->count();
    }

    /**
    * 
    * 
    **/
    public function have_address(){
        return (bool)$this->user_address->count();
    }

    /**
    * get User detail
    * @return joined one to one
    **/
    public function user_detail()
    {
        return $this->hasOne('App\Models\User_detail', 'user_detail_user_id');
    }

    /**
    * get user bank
    * @return joined one to one
    **/
    public function user_bank()
    {
        return $this->hasMany('App\Models\User_bank', 'user_bank_user_id');
    }

    /**
    * get user address
    * @return joined one to one
    **/
    public function user_address()
    {
        return $this->hasMany('App\Models\User_address', 'user_address_user_id');
    }

    /**
    * get user shipment
    * @return joined one to one
    **/
    public function user_shipment()
    {
        return $this->hasMany('App\Models\User_shipment', 'user_shipment_user_id');
    }

    public function MailVerification(){
        return true;
    }

}
