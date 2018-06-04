<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userProfile_setting extends Model
{
	
	
	protected $table = 'userprofilesettings';
	
	 protected $fillable = ['uid','contact', 'PostDisplay','updated_at'];
	public $timestamps = true;  
}