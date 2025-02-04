<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Speaker extends Model
{
	protected $table = 'speakers';
	protected $with = 'program';

	protected $fillable = [
		'name',
		'email',
		'origin',
		'gender',
		'phone_number',
		'program_id',
		'date_of_visit',
		'photo',
	];

	public function program(): BelongsTo
	{
		return $this->belongsTo(Program::class);
	}
}
