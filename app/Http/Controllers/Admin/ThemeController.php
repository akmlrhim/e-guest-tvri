<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeTheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ThemeController extends Controller
{
	public function index($id = null)
	{
		$title = 'Tema';
		$theme = HomeTheme::latest()->first();
		return view('admin.theme.index', compact('title', 'theme'));
	}

	public function edit()
	{
		$data = [
			'title' => 'Edit Tema',
			'theme' => HomeTheme::latest()->first()
		];

		return view('admin.theme.edit', $data);
	}

	public function updateLogo($id, Request $request)
	{
		$request->validate(
			[
				'logo' => 'required|mimes:png,jpg,jpeg'
			],
			[
				'logo.required' => 'Upload logo terlebih dahulu',
				'logo.mime' => 'Format logo harus png, jpg, jpeg'
			]
		);

		$theme = HomeTheme::findOrFail($id);

		if ($request->hasFile('logo')) {
			$file = $request->file('logo');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$request->file('logo')->storeAs('logo', $fileName, 'public');

			$theme->update(['logo' => $fileName]);
		}

		toast('Logo berhasil diubah !', 'success');
		return redirect()->back();
	}

	public function updateBackground($id, Request $request)
	{
		$request->validate(
			[
				'background_image' => 'required|mimes:png,jpg,jpeg'
			],
			[
				'background_image.required' => 'Upload background terlebih dahulu',
				'background_image.mime' => 'Format background harus png, jpg, jpeg'
			]
		);

		$theme = HomeTheme::findOrFail($id);

		if ($request->hasFile('background_image')) {
			$file = $request->file('background_image');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$request->file('background_image')->storeAs('background', $fileName, 'public');

			$theme->update(['background_image' => $fileName]);
		}

		toast('Background berhasil diubah !', 'success');
		return redirect()->back();
	}
}
