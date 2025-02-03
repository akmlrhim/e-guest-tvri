<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SpeakerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});

// Route autentikasi
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.process');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard route 
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// acara route 
Route::prefix('acara')->group(function () {
	Route::get('/', [ProgramController::class, 'index'])->name('program');
	Route::get('show', [ProgramController::class, 'show'])->name('program.show');
	Route::get('tambah', [ProgramController::class, 'create'])->name('program.create');
	Route::post('store', [ProgramController::class, 'store'])->name('program.store');
	Route::get('{id}/edit', [ProgramController::class, 'edit'])->name('program.edit');
	Route::put('{id}/update', [ProgramController::class, 'update'])->name('program.update');
	Route::delete('{id}/delete', [ProgramController::class, 'destroy'])->name('program.destroy');
});

// free user route
Route::prefix('portal')->group(function () {

	// route tamu 
	Route::prefix('tamu')->group(function () {
		Route::get('/', [GuestController::class, 'index'])->name('tamu');
		Route::get('{id}/id-card', [GuestController::class, 'card'])->name('tamu.id.card');
	});

	// route narasumber
	Route::prefix('narasumber')->group(function () {
		Route::get('/', [SpeakerController::class, 'index'])->name('narasumber');
	});

	// route magang 
	Route::prefix('magang')->group(function () {
		Route::get('/', [InternController::class, 'index'])->name('magang');
		Route::post('/', [InternController::class, 'store'])->name('magang.store');
		Route::get('{id}/id-card', [InternController::class, 'card'])->name('magang.id.card')->middleware('intern-submitted');
		Route::post('finished', [InternController::class, 'finished'])->name('magang.finished');
	});
});
