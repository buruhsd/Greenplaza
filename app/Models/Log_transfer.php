<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_transfer extends Model
{
	protected $table = 'log_transfer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transfer_user_id','transfer_from','transfer_to_user_id','transfer_to','transfer_code_reff','transfer_type','transfer_nominal','transfer_response','transfer_note','created_at','updated_at'
    ];
}
