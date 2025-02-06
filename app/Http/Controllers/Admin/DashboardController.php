<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guest;
use App\Models\Intern;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Speaker;

class DashboardController extends Controller
{
	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'magang' => Intern::count(),
			'tamu' => Guest::count(),
			'narasumber' => Speaker::count(),
			'acara' => Program::count(),
		];

		return view('admin.dashboard.index', $data);
	}
}
