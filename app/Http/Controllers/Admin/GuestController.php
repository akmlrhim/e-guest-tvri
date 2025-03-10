<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Guest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
	public function index()
	{
		$title = 'Tamu';
		$guest = Guest::get();
		return view('admin.tamu.index', compact('title', 'guest'));
	}

	// server side untuk menampilkan data tamu menggunakan AJAX
	public function show(Request $request)
	{
		// memilih kolom yang ada di dalam tabel tamu (guest)
		$builder = Guest::select('id', 'name', 'gender', 'origin', 'objectives', 'email', 'phone_number', 'created_at');

		// mengurutkan terbaru atau terlama
		$sortOrder = $request->input('sortOrder', 'desc');
		$builder->orderBy('created_at', $sortOrder);

		// filter berdasarkan rentang waktu 
		if ($request->has('startDate') && $request->has('endDate')) {
			$startDate = Carbon::parse($request->startDate)->startOfDay();
			$endDate = Carbon::parse($request->endDate)->endOfDay();
			$builder->whereBetween('created_at', [$startDate, $endDate]);
		}

		// pengambilan data menggunakan datatable
		return DataTables::of($builder)
			->addIndexColumn() // penomoran
			->addColumn('gender', function ($row) {
				return $row->gender == 'laki_laki' ? 'Laki-laki' : 'Perempuan';
			}) //format jenis kelamin
			->addColumn('action', function ($row) {
				return '<a href="' . route('admin.tamu.edit', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
								<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal' . $row->id . '">
									Hapus
								</button>'; //tombol aksi untuk edit dan hapus
			})
			->rawColumns(['action']) // menambahkan kolom aksi tadi ke kolom
			->make(true);
	}

	public function edit($id)
	{
		$title = 'Edit Tamu';
		$guest = Guest::findOrFail($id); // findOrFail berfungsi untuk men throw error jika data tidak ditemukan
		return view('admin.tamu.edit', compact('title', 'guest')); // compact : melempar variabel ke views
	}

	public function update(Request $request, $id)
	// request untuk mengirimkan permintaan ke server / db, id untuk mengambil data berdasarkan id yang diambil
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'origin' => 'required',
			'phone_number' => 'required|numeric',
			'gender' => 'required',
			'objectives' => 'required',
		], [
			'name.required' => 'Nama wajib diisi',
			'email.required' => 'Email wajib diisi',
			'email.email' => 'Format email salah',
			'origin.required' => 'Asal wajib diisi',
			'phone_number.required' => 'Nomor telepon wajib diisi',
			'phone_number.numeric' => 'Nomor telepon harus berupa angka',
			'gender.required' => 'Jenis kelamin wajib diisi',
			'objectives.required' => 'Tujuan wajib diisi',
		]);

		Guest::findOrFail($id)->update($request->all());

		toast('Data berhasil diubah', 'success');
		return redirect()->route('admin.tamu');
	}

	public function destroy($id)
	{
		$guest = Guest::findOrFail($id);

		if ($guest) {
			if ($guest->photo) {
				Storage::disk('public')->delete('tamu/' . $guest->photo);
			}
		}

		$guest->delete();
		toast('Data berhasil dihapus', 'success');
		return redirect()->route('admin.tamu');
	}

	public function print(Request $request)
	{
		$request->validate([
			'startDate' => 'required|date',
			'endDate' => 'required|date',
		]);

		$startDate = Carbon::parse($request->input('startDate'))->startOfDay()->format('Y-m-d');
		$endDate = Carbon::parse($request->input('endDate'))->endOfDay()->format('Y-m-d');

		$guests = Guest::whereBetween('created_at', [$startDate, $endDate])
			->orderBy('created_at', 'desc')
			->get();

		if ($guests->isEmpty()) {
			toast('Tidak ada data tamu dalam rentang tanggal yang dipilih.', 'error');
			return redirect()->back();
		}

		$pdf = Pdf::loadView('admin.tamu.report', [
			'guests' => $guests,
			'startDate' => $startDate,
			'endDate' => $endDate
		]);

		return $pdf->download('Data Tamu ' . $startDate . ' - ' . $endDate . '.pdf');
	}
}
