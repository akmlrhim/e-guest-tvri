<?php

namespace App\Http\Controllers\FreeUser;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use App\Mail\GuestIdCardMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
			'photo.required' => 'Ambil foto terlebih dahulu',
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
		$guest = Guest::findOrFail($id);

		return view('free_user.tamu.card', compact('guest', 'title'));
	}

	public function sendToEmail($id)
	{
		$guest = Guest::findOrFail($id);

		if (!$guest) {
			toast('Data tidak ditemukan', 'error');
			return redirect()->back();
		}

		try {
			Mail::to($guest->email)->send(new GuestIdCardMail($guest));
			toast('Email berhasil dikirim', 'success');
			return redirect()->route('tamu.id.card', ['id' => $guest->id]);
		} catch (\Error $e) {
			Log::error($e);
			toast('Email gagal dikirim', 'error');
			return redirect()->route('tamu.id.card', ['id' => $guest->id]);
		}
	}

	public function printCard($id)
	{
		$guest = Guest::findOrFail($id);

		$pdf = Pdf::loadView('free_user.tamu.pdf', ['guest' => $guest]);
		return $pdf->download($guest->name . ' - ID Card.pdf');
	}

	public function finished(Request $request)
	{
		if (session()->has('guest-submitted')) {
			$request->session()->forget('guest-submitted');
		} else {
			$request->session()->flush();
		}

		toast('Terimakasih telah menggunakan layanan kami', 'info');
		return redirect('/');
	}
}
