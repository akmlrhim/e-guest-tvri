<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Http\Request;

class InternController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return view('free_user.magang.index');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Intern $Intern)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Intern $Intern)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Intern $Intern)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Intern $Intern)
	{
		//
	}
}
