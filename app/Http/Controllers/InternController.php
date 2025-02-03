<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternController extends Controller
{

	public function index()
	{
		$title = 'Magang';
		return view('free_user.magang.index', compact('title'));
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
				'email' => 'required|email',
				'phone_number' => 'required|numeric',
				'address' => 'required',
				'parent_number' => 'required|numeric',
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
				'email.email' => 'Format email salah',
				'phone_number.required' => 'Nomor telepon wajib diisi',
				'phone_number.numeric' => 'Nomor telepon harus angka',
				'address.required' => 'Alamat wajib diisi',
				'parent_number.required' => 'Nomor orang tua wajib diisi',
				'parent_number.numeric' => 'Nomor orang tua harus angka',
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

		$intern = Intern::create([
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

		session(['intern-submitted' => true]);

		toast('Sukses menyimpan data', 'success');
		return redirect()->route('magang.id.card', ['id' => $intern->id]);
	}

	public function card($id)
	{
		$title = 'ID Card';
		$intern = Intern::find($id);
		return view('free_user.magang.card', compact('intern', 'title'));
	}

	public function printCard($id) {}

	public function sendToWhatsapp(Request $request) {}

	public function finished(Request $request)
	{
		if (session()->has('intern-submitted')) {
			$request->session()->forget('intern-submitted');
		} else {
			$request->session()->flush();
		}

		toast('Terimakasih telah menggunakan layanan kami', 'success');
		return redirect('/');
	}
}
