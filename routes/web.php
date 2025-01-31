<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
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
	Route::get('/', [EventController::class, 'index'])->name('event');
	Route::get('show', [EventController::class, 'show'])->name('event.show');
	Route::get('tambah', [EventController::class, 'create'])->name('event.create');
	Route::post('store', [EventController::class, 'store'])->name('event.store');
	Route::get('{id}/edit', [EventController::class, 'edit'])->name('event.edit');
	Route::put('{id}/update', [EventController::class, 'update'])->name('event.update');
	Route::delete('{id}/delete', [EventController::class, 'destroy'])->name('event.destroy');
});
