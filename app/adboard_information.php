<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adboard_information extends Model
{
	
	
	protected $table = 'adboard_data';
	
	 protected $fillable = ['title', 'description', 'url', 'time','image'];
	public $timestamps = false;  
}