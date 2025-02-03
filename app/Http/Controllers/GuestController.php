<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
	public function index()
	{
		$title = 'Tamu';
		return view('free_user.tamu.index', compact('title'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'origin' => 'required',
			'phone_number' => 'required|numeric',
			'gender' => 'required',
			'objectives' => 'required',
			'photo' => 'required',
		], [
			'name.required' => 'Nama wajib diisi',
			'email.required' => 'Email wajib diisi',
			'email.email' => 'Format email salah',
			'origin.required' => 'Asal wajib diisi',
			'phone_number.required' => 'Nomor telepon wajib diisi',
			'phone_number.numeric' => 'Nomor telepon harus berupa angka',
			'gender.required' => 'Jenis kelamin wajib diisi',
			'objectives.required' => 'Tujuan wajib diisi',
			'photo.required' => 'Foto wajib diisi',
		]);

		$imageData = $request->photo;

		if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $matches)) {
			$imageType = $matches[1];
			$filename = time() . '.' . $imageType;
			$imageData = substr($imageData, strpos($imageData, ',') + 1);
			Storage::disk('public')->put('tamu/' . $filename, base64_decode($imageData));
		}

		$guest = Guest::create([
			'name' => $request->name,
			'origin' => $request->origin,
			'email' => $request->email,
			'phone_number' => $request->phone_number,
			'gender' => $request->gender,
			'objectives' => $request->objectives,
			'photo' => $filename,
		]);

		session(['guest-submitted' => true]);

		toast('Sukses menyimpan  data', 'success');
		return redirect()->route('tamu.id.card', ['id' => $guest->id]);
	}

	public function card($id)
	{
		$title = 'ID Card';
		$guest = Guest::find($id);

		return view('free_user.tamu.card', compact('guest', 'title'));
	}
}
