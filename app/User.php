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
    * get wallet user
    * @return joined one to one
    **/
    public function user_detail()
    {
        return $this->hasOne('App\Models\User_detail', 'user_detail_user_id');
    }

    /**
    * get wallet user
    * @return joined one to one
    **/
    public function user_bank()
    {
        return $this->hasMany('App\Models\User_bank', 'user_bank_user_id');
    }

    /**
    * get wallet user
    * @return joined one to one
    **/
    public function user_address()
    {
        return $this->hasMany('App\Models\User_address', 'user_address_user_id');
    }

    public function MailVerification(){
        return true;
    }

}
