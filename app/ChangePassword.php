<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangePassword extends Model
{
	protected $table = 'changepassword';
	protected $fillable = ['token','uid'];
	//public $timestamps = false;  
}