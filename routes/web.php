<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\AtpController;
use App\Http\Controllers\Admin;

// ── Halaman publik ──
Route::get('/', fn() => view('welcome'))->name('home');

Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
Route::get('/materi/{materi}', [MateriController::class, 'show'])->name('materi.show');

Route::get('/video', [VideoController::class, 'index'])->name('video.index');

// ATP — pakai controller agar baca dari DB
Route::get('/atp', [AtpController::class, 'index'])->name('atp');

// Evaluasi publik
Route::get('/evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi');

Route::get('/profil', fn() => view('profile.index'))->name('profil');

// ── Auth ──
require __DIR__ . '/auth.php';

// ── Admin ──
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

    Route::resource('materi',   Admin\MateriController::class);
    Route::resource('video',    Admin\VideoController::class);
    Route::resource('evaluasi', Admin\EvaluasiController::class);
    Route::resource('evaluasi.soal', Admin\SoalController::class)->shallow();

    // ATP admin
    Route::resource('atp', Admin\AtpController::class);
});

// ── Dashboard user ──
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth'])->name('dashboard');
