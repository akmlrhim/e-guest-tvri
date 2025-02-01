<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
	protected $table = 'interns';

	protected $fillable = [
		'name',
		'gender',
		'institution',
		'birthplace',
		'date_of_birth',
		'start',
		'end',
		'email',
		'phone_number',
		'address',
		'parent_number',
		'photo',
	];
}
