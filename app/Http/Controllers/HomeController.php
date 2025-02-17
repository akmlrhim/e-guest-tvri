<?php

namespace App\Http\Controllers;

use App\Models\HomeTheme;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
		$title = 'Home';
		$theme = HomeTheme::latest()->first();

		return view('welcome', compact('title', 'theme'));
	}
}
