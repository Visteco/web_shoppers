<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApprovalRequest extends Model
{
	protected $table = 'approval_requests';
	public $timestamps = false;  
}