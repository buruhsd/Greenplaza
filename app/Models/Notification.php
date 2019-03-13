<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $table = 'notifications';
    protected $casts = ['id' => 'string'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','notifiable_type','notifiable_id','data','read_at',
    ];

    /**
    * @param
    * @return
    * 
    */
    public function child()
    {
        return $this->belongsTo($this->notifiable_type, 'notifiable_id');
    }
}
