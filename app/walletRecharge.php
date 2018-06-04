<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class walletRecharge extends Model
{
	protected $table = 'recharges';
	protected $fillable = ['recharger_id', 'recharge_amount', 'recharge_date'];
	public $timestamps = false;  
}