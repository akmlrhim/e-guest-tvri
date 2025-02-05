<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FreeUser\GuestController;
use App\Http\Controllers\FreeUser\InternController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\FreeUser\SpeakerController;
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
		Route::post('/', [GuestController::class, 'store'])->name('tamu.store');
		Route::get('{id}/id-card', [GuestController::class, 'card'])->name('tamu.id.card')->middleware('guest-submitted');
		Route::post('{id}/id-card-send', [GuestController::class, 'sendToEmail'])->name('tamu.id.card.send')->middleware('guest-submitted');
		Route::get('{id}/print-id-card', [GuestController::class, 'printCard'])->name('tamu.id.card.print')->middleware('guest-submitted');
		Route::post('finished', [GuestController::class, 'finished'])->name('tamu.finished');
	});

	// route narasumber
	Route::prefix('narasumber')->group(function () {
		Route::get('/', [SpeakerController::class, 'index'])->name('narasumber');
		Route::post('/', [SpeakerController::class, 'store'])->name('narasumber.store');
		Route::get('{id}/id-card', [SpeakerController::class, 'card'])->name('narasumber.id.card')->middleware('speaker-submitted');
		Route::post('{id}/id-card-send', [SpeakerController::class, 'sendToEmail'])->name('narasumber.id.card.send')->middleware('speaker-submitted');
		Route::get('{id}/print-id-card', [SpeakerController::class, 'printCard'])->name('narasumber.id.card.print')->middleware('speaker-submitted');
		Route::post('finished', [SpeakerController::class, 'finished'])->name('narasumber.finished');
	});

	// route magang 
	Route::prefix('magang')->group(function () {
		Route::get('/', [InternController::class, 'index'])->name('magang');
		Route::post('/', [InternController::class, 'store'])->name('magang.store');
		Route::get('{id}/id-card', [InternController::class, 'card'])->name('magang.id.card')->middleware('intern-submitted');
		Route::post('{id}/id-card-send', [InternController::class, 'sendToEmail'])->name('magang.id.card.send')->middleware('intern-submitted');
		Route::get('{id}/print-id-card', [InternController::class, 'printCard'])->name('magang.id.card.print')->middleware('intern-submitted');
		Route::post('finished', [InternController::class, 'finished'])->name('magang.finished');
	});
});
