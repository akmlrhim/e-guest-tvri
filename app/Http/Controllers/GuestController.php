<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
	public function index()
	{
		return view('free_user.tamu.index');
	}

	public function store(Request $request)
	{
		//
	}
}
