<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeTheme extends Model
{
	protected $table = 'home_theme';
	protected $fillable = ['logo', 'background_image'];
}
