<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans extends Model
{
	protected $table = 'sys_trans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'trans_code', 'trans_user_id', 'trans_user_bank_id', 'trans_is_paid', 'trans_payment_id', 'trans_paid_image', 'trans_paid_date', 'trans_paid_note', 'trans_amount', 'trans_amount_ship', 'trans_amount_total', 'trans_note', 
	];
}
