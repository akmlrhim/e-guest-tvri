<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		if (!Auth::check()) {
			toast('Silahkan login terlebih dahulu !', 'error');
			return redirect()->back();
		}

		$user = Auth::user();
		if (!User::where('id', $user->id)->exists()) {
			toast('Tindakan tidak diizinkan !', 'error');
			return redirect()->back();
		}

		return $next($request);
	}
}
