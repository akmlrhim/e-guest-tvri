<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Intern;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class InternController extends Controller
{
	public function index()
	{
		$title = 'Peserta Magang';
		$intern = Intern::get();
		return view('admin.magang.index', compact('title', 'intern'));
	}

	public function show(Request $request)
	{
		$builder = Intern::select('id', 'name', 'gender', 'institution', 'start', 'end', 'created_at');

		$sortOrder = $request->input('sortOrder', 'desc');
		$builder->orderBy('created_at', $sortOrder);

		return DataTables::of($builder)
			->addIndexColumn()
			->addColumn('gender', function ($row) {
				return $row->gender == 'laki_laki' ? 'Laki-laki' : 'Perempuan';
			})
			->addColumn('start', function ($row) {
				return Carbon::parse($row->start)->locale('id')->translatedFormat('d F Y');
			})
			->addColumn('end', function ($row) {
				return Carbon::parse($row->end)->locale('id')->translatedFormat('d F Y');
			})
			->addColumn('action', function ($row) {
				return '<a href="' . route('admin.magang.detail', $row->id) . '" class="btn btn-primary btn-sm">Detail</a>
								<a href="' . route('admin.magang.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
								<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal' . $row->id . '">
									Hapus
								</button>';
			})
			->rawColumns(['action'])
			->make(true);
	}

	public function detail($id)
	{
		$title = 'Detail Peserta Magang';
		$intern = Intern::findOrFail($id);
		return view('admin.magang.detail', compact('title', 'intern'));
	}

	public function edit($id)
	{
		$title = 'Edit Peserta Magang';
		$intern = Intern::findOrFail($id);
		return view('admin.magang.edit', compact('title', 'intern'));
	}

	public function update(Request $request, $id)
	{
		$request->validate(
			[
				'name' => 'required',
				'gender' => 'required',
				'institution' => 'required',
				'birthplace' => 'required',
				'date_of_birth' => 'required',
				'start' => 'required',
				'end' => 'required',
				'email' => 'required|email',
				'phone_number' => 'required|numeric',
				'address' => 'required',
				'parent_number' => 'required|numeric',
			],
			[
				'name.required' => 'Nama wajib diisi',
				'gender.required' => 'Jenis kelamin wajib diisi',
				'institution.required' => 'Institusi wajib diisi',
				'birthplace.required' => 'Tempat lahir wajib diisi',
				'date_of_birth.required' => 'Tanggal lahir wajib diisi',
				'start.required' => 'Tanggal mulai wajib diisi',
				'end.required' => 'Tanggal selesai wajib diisi',
				'email.required' => 'Email wajib diisi',
				'email.email' => 'Format email salah',
				'phone_number.required' => 'Nomor telepon wajib diisi',
				'phone_number.numeric' => 'Nomor telepon harus angka',
				'address.required' => 'Alamat wajib diisi',
				'parent_number.required' => 'Nomor orang tua wajib diisi',
				'parent_number.numeric' => 'Nomor orang tua harus angka',
			]
		);

		Intern::findOrFail($id)->update($request->all());
		toast('Data berhasil diubah', 'success');
		return redirect()->route('admin.magang');
	}

	public function destroy($id)
	{
		$intern = Intern::findOrFail($id);

		if ($intern) {
			if ($intern->photo) {
				Storage::disk('public')->delete('magang/' . $intern->photo);
			}
		}

		$intern->delete();
		toast('Data berhasil dihapus', 'success');
		return redirect()->route('admin.magang');
	}
}
