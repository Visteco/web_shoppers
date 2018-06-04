<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userProfile extends Model
{
	protected $table = 'userprofiles';
	protected $fillable = ['fname','img','background_img','facebook','twitter','skype','googleplus','youtube','linkedin'];
	//public $timestamps = false;  
}