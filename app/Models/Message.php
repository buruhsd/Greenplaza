<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $table = 'sys_message';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'message_from_id', 'message_to_id', 'message_subject', 'message_text', 'message_status_from', 'message_status_to', 'message_is_read'
    ];

    /**
    * @param
    * @return
    * 
    */
    public function from()
    {
        return $this->belongsTo('App\User', 'message_from_id');
    }

    /**
    * @param
    * @return
    * 
    */
    public function to()
    {
        return $this->belongsTo('App\User', 'message_to_id');
    }
}
