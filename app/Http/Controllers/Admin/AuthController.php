<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function index()
	{
		return view('admin.auth.login');
	}

	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'password' => 'required',
		], [
			'email.required' => 'Email harus diisi',
			'email.email' => 'Email tidak valid',
			'password.required' => 'Password harus diisi'
		]);

		$credentials = [
			'email' => $request->email,
			'password' => $request->password,
		];

		if (Auth::attempt($credentials)) {
			toast('Berhasil login', 'success');
			return redirect()->route('dashboard');
		}

		toast('Email atau password salah', 'error');
		return redirect()->back()->withInput($request->only('email'));
	}

	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		toast('Anda telah logout!', 'info');
		return redirect()->route('login');
	}
}
