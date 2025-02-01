<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternController extends Controller
{

	public function index()
	{
		return view('free_user.magang.index');
	}

	public function store(Request $request)
	{
		$request->validate(
			[
				'name' => 'required',
				'gender' => 'required',
				'institution' => 'required',
				'birthplace' => 'required',
				'date_of_birth' => 'required',
				'start' => 'required|after:today',
				'end' => 'required|after:start',
				'email' => 'required',
				'phone_number' => 'required',
				'address' => 'required',
				'parent_number' => 'required',
				'photo' => 'required',
			],
			[
				'name.required' => 'Nama wajib diisi',
				'gender.required' => 'Jenis kelamin wajib diisi',
				'institution.required' => 'Institusi wajib diisi',
				'birthplace.required' => 'Tempat lahir wajib diisi',
				'date_of_birth.required' => 'Tanggal lahir wajib diisi',
				'start.required' => 'Tanggal mulai wajib diisi',
				'start.after' => 'Tanggal mulai harus setelah tanggal sekarang',
				'end.required' => 'Tanggal selesai wajib diisi',
				'end.after' => 'Tanggal selesai harus setelah tanggal mulai',
				'email.required' => 'Email wajib diisi',
				'phone_number.required' => 'Nomor telepon wajib diisi',
				'address.required' => 'Alamat wajib diisi',
				'parent_number.required' => 'Nomor orang tua wajib diisi',
				'photo.required' => 'Ambil foto terlebih dahulu',
			]
		);

		$imageData = $request->photo;

		if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $matches)) {
			$imageType = $matches[1];
			$filename = time() . '.' . $imageType;
			$imageData = substr($imageData, strpos($imageData, ',') + 1);
			Storage::disk('public')->put('magang/' . $filename, base64_decode($imageData));
		}

		Intern::create([
			'name' => $request->name,
			'gender' => $request->gender,
			'institution' => $request->institution,
			'birthplace' => $request->birthplace,
			'date_of_birth' => $request->date_of_birth,
			'start' => $request->start,
			'end' => $request->end,
			'email' => $request->email,
			'phone_number' => $request->phone_number,
			'address' => $request->address,
			'parent_number' => $request->parent_number,
			'photo' => $filename
		]);

		toast('Magang berhasil ditambahkan', 'success');
		return redirect()->back();
	}
}
