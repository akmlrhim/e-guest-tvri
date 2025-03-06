<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Intern;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

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

		//sort terbaru atau terlama
		$sortOrder = $request->input('sortOrder', 'desc');
		$builder->orderBy('created_at', $sortOrder);

		// filter berdasarkan rentang waktu 
		if ($request->has('startDate') && $request->has('endDate')) {
			$startDate = Carbon::parse($request->startDate)->startOfDay();
			$endDate = Carbon::parse($request->endDate)->endOfDay();
			$builder->whereBetween('created_at', [$startDate, $endDate]);
		}

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
				return '<a href="' . route('admin.magang.detail', $row->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i></a>
								<a href="' . route('admin.magang.edit', $row->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
								<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal' . $row->id . '">
									<i class="fas fa-trash"></i>
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

	public function print(Request $request)
	{
		$request->validate([
			'startDate' => 'required|date',
			'endDate' => 'required|date',
		]);

		$startDate = Carbon::parse($request->input('startDate'))->startOfDay()->format('Y-m-d');
		$endDate = Carbon::parse($request->input('endDate'))->endOfDay()->format('Y-m-d');

		$interns = Intern::whereBetween('created_at', [$startDate, $endDate])
			->orderBy('created_at', 'desc')
			->get();

		if ($interns->isEmpty()) {
			toast('Tidak ada data magang dalam rentang tanggal yang dipilih.', 'warning');
			return redirect()->back();
		}

		$pdf = Pdf::loadView('admin.magang.report', [
			'interns' => $interns,
			'startDate' => $startDate,
			'endDate' => $endDate
		])->setPaper('a4', 'landscape');

		return $pdf->download('Data Magang ' . $startDate . ' - ' . $endDate . '.pdf');
	}
}
