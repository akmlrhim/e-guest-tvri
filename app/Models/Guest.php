<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
	protected $table = 'guests';

	protected $fillable = [
		'name',
		'origin',
		'email',
		'phone_number',
		'gender',
		'objectives',
		'photo',
	];
}
