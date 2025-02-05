<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;

class SpeakerController extends Controller
{
	public function index()
	{
		$title = 'Narasumber';
		$speaker = Speaker::get();

		return view('admin.narasumber.index', compact('title', 'speaker'));
	}

	public function show(Request $request)
	{
		$builder = Speaker::select(
			'speakers.id',
			'speakers.name',
			'speakers.email',
			'speakers.origin',
			'speakers.gender',
			'speakers.phone_number',
			'programs.program_name',
			'speakers.date_of_visit',
			'speakers.created_at'
		)
			->join('programs', 'speakers.program_id', '=', 'programs.id');

		$sortOrder = $request->input('sortOrder', 'desc');
		$builder->orderBy('created_at', $sortOrder);

		return DataTables::of($builder)
			->addIndexColumn()
			->addColumn('gender', function ($row) {
				return $row->gender == 'laki_laki' ? 'Laki-laki' : 'Perempuan';
			})
			->addColumn('date_of_visit', function ($row) {
				return Carbon::parse($row->date_of_visit)->locale('id')->translatedFormat('d F Y');
			})
			->addColumn('action', function ($row) {
				return '<a href="' . route('admin.narasumber.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
								<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal' . $row->id . '">
									Hapus
								</button>';
			})
			->rawColumns(['action'])
			->make(true);
	}

	public function edit($id)
	{
		$title = 'Edit Narasumber';
		$speaker = Speaker::findOrFail($id);
		$program = Program::get();

		return view('admin.narasumber.edit', compact('title', 'speaker', 'program'));
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'origin' => 'required',
			'gender' => 'required',
			'phone_number' => 'required|numeric',
			'program_id' => 'required',
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
			'date_of_visit.required' => 'Tanggal kunjungan wajib diisi',
		]);

		Speaker::findOrFail($id)->update($request->all());
		toast('Data berhasil diubah', 'success');
		return redirect()->route('admin.narasumber');
	}

	public function destroy($id)
	{
		$speaker = Speaker::findOrFail($id);

		if ($speaker) {
			if ($speaker->photo) {
				Storage::disk('public')->delete('tamu/' . $speaker->photo);
			}
		}

		$speaker->delete();
		toast('Data berhasil dihapus', 'success');
		return redirect()->route('admin.narasumber');
	}
}
