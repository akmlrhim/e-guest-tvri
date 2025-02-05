<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProgramController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data['title'] = 'Acara';
		$data['program'] = Program::get();
		return view('admin.acara.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['title'] = 'Tambah Acara';
		return view('admin.acara.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$request->validate([
			'program_name' => 'required|unique:programs,program_name,except,id',
			'days' => 'required',
			'start_time' => 'required',
			'end_time' => 'required',
		], [
			'program_name.required' => 'Nama acara harus diisi',
			'program_name.unique' => 'Nama acara sudah ada',
			'days.required' => 'Hari tayang harus dipilih',
			'start_time.required' => 'Jam mulai harus diisi',
			'end_time.required' => 'Jam selesai harus diisi',
		]);

		$days = implode(',', $request->days);

		Program::create([
			'program_name' => $request->program_name,
			'days' => $days,
			'start_time' => $request->start_time,
			'end_time' => $request->end_time,
		]);

		toast('Acara baru telah ditambahkan', 'success');
		return redirect()->route('program');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request)
	{
		$builder = Program::select('id', 'program_name', 'days', 'start_time', 'end_time', 'created_at');

		$sortOrder = $request->input('sortOrder', 'desc');
		$builder->orderBy('created_at', $sortOrder);

		return DataTables::of($builder)
			->addIndexColumn()
			->addColumn('showtime', function ($row) {
				return date('H:i', strtotime($row->start_time)) . ' - ' . date('H:i', strtotime($row->end_time));
			})
			->addColumn('action', function ($row) {
				return '<a href="' . route('acara.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>
											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal' . $row->id . '">
													Hapus
									</button>';
			})
			->rawColumns(['action'])
			->make(true);
	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(int $id)
	{
		$data = [
			'title' => 'Edit Acara',
			'program' => Program::findOrFail($id),
		];

		return view('admin.acara.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, int $id)
	{
		$request->validate([
			'program_name' => 'required',
			'days' => 'required',
			'start_time' => 'required',
			'end_time' => 'required',
		], [
			'program_name.required' => 'Nama acara harus diisi',
			'days.required' => 'Hari tayang harus dipilih',
			'start_time.required' => 'Jam mulai harus diisi',
			'end_time.required' => 'Jam selesai harus diisi',
		]);

		$days = implode(',', $request->days);

		Program::findOrFail($id)->update([
			'program_name' => $request->program_name,
			'days' => $days,
			'start_time' => $request->start_time,
			'end_time' => $request->end_time,
		]);

		toast('Acara telah berhasil diubah', 'success');
		return redirect()->route('program');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(int $id)
	{
		Program::find($id)->delete();

		toast('Acara telah berhasil dihapus', 'success');
		return redirect()->route('program');
	}
}
