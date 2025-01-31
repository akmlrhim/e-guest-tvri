<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	protected $table = 'programs';

	protected $fillable = ['program_name', 'days', 'start_time', 'end_time'];
}
