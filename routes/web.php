<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DokumenSuratController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisSuratController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes with role protection
Route::middleware(['auth', CheckRole::class . ':Master Admin'])->group(function () {
    Route::resource('jenis_surat', JenisSuratController::class);
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('/logs', [LogController::class, 'index']);
});

Route::middleware(['auth', CheckRole::class . ':Mahasiswa'])->group(function () {
    Route::resource('surat', SuratController::class);
    Route::post('/dokumen_surat', [DokumenSuratController::class, 'store']);
    Route::get('/dokumen_surat/{id}/download', [DokumenSuratController::class, 'download']);
});

Route::middleware(['auth', CheckRole::class . ':Kepala Prodi,Tata Usaha'])->group(function () {
    Route::post('/approval', [ApprovalController::class, 'store']);
});

// Status terbuka untuk semua yang login
Route::middleware(['auth'])->group(function () {
    Route::get('/statuses', [StatusController::class, 'index']);
});

require __DIR__.'/auth.php';
