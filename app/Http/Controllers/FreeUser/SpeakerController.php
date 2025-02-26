<?php

namespace App\Http\Controllers\FreeUser;

use App\Models\Program;
use App\Models\Speaker;
use App\Models\HomeTheme;
use Illuminate\Http\Request;
use App\Mail\SpeakerIdCardMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SpeakerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$title = 'Narasumber';
		$bg = HomeTheme::latest()->first();
		$program = Program::get();
		return view('free_user.narasumber.index', compact('title', 'program', 'bg'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'origin' => 'required',
			'gender' => 'required',
			'phone_number' => 'required|numeric',
			'program_id' => 'required',
			'photo' => 'required',
			'date_of_visit' => 'required',
		], [
			'name.required' => 'Nama wajib diisi',
			'email.required' => 'Email wajib diisi',
			'email.email' => 'Format email salah',
			'origin.required' => 'Asal wajib diisi',
			'gender.required' => 'Jenis kelamin wajib diisi',
			'phone_number.required' => 'Nomor telepon wajib diisi',
			'phone_number.numeric' => 'Nomor telepon harus berupa angka',
			'program_id.required' => 'Program wajib dipilih',
			'photo.required' => 'Ambil foto terlebih dahulu',
			'date_of_visit.required' => 'Tanggal kunjungan wajib diisi',
		]);

		$imageData = $request->photo;

		if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $matches)) {
			$imageType = $matches[1];
			$filename = time() . '.' . $imageType;
			$imageData = substr($imageData, strpos($imageData, ',') + 1);
			Storage::disk('public')->put('narasumber/' . $filename, base64_decode($imageData));
		}

		$speaker = Speaker::create([
			'name' => $request->name,
			'origin' => $request->origin,
			'email' => $request->email,
			'phone_number' => $request->phone_number,
			'gender' => $request->gender,
			'program_id' => $request->program_id,
			'date_of_visit' => $request->date_of_visit,
			'photo' => $filename,
		]);

		session(['speaker-submitted' => true]);

		toast('Sukses menyimpan data', 'success');
		return redirect()->route('narasumber.id.card', ['id' => $speaker->id]);
	}

	public function card($id)
	{
		$title = 'ID Card';
		$bg = HomeTheme::latest()->first();
		$speaker = Speaker::findOrFail($id);

		return view('free_user.narasumber.card', compact('speaker', 'title', 'bg'));
	}

	public function printCard($id)
	{
		$speaker = Speaker::findOrFail($id);

		$pdf = Pdf::loadView('free_user.narasumber.pdf', ['speaker' => $speaker]);
		return $pdf->stream($speaker->name . ' - ID Card.pdf');
	}

	public function sendToEmail($id)
	{
		$speaker = Speaker::findOrFail($id);

		if (!$speaker) {
			toast('Data tidak ditemukan', 'error');
			return redirect()->back();
		}

		try {
			Mail::to($speaker->email)->send(new SpeakerIdCardMail($speaker));
			toast('Email berhasil dikirim', 'success');
			return redirect()->route('narasumber.id.card', ['id' => $speaker->id]);
		} catch (\Error $e) {
			Log::error($e);
			toast('Email gagal dikirim', 'error');
			return redirect()->route('narasumber.id.card', ['id' => $speaker->id]);
		}
	}

	public function finished(Request $request)
	{
		if (session()->has('speaker-submitted')) {
			$request->session()->forget('speaker-submitted');
		} else {
			$request->session()->flush();
		}

		toast('Terimakasih telah menggunakan layanan kami', 'info');
		return redirect('/');
	}
}
