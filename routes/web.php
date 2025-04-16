<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Middleware\CekRole;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\DokumenSuratController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\Auth\VerifyEmailController;

// ========== ROUTE UTAMA ==========
Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role->name;

        return match ($role) {
            'Master Admin' => redirect()->route('admin.dashboard'),
            'Tata Usaha' => redirect()->route('tataUsaha.dashboard'),
            'Kepala Prodi' => redirect()->route('kaprodi.dashboard'),
            'Mahasiswa' => redirect()->route('mahasiswa.dashboard'),
            default => abort(403, 'Role Anda tidak memiliki akses yang sesuai.')
        };
    }

    return redirect()->route('login');
});

// ========== VERIFIKASI EMAIL ==========
Route::get('/email/verify', VerifyEmailController::class)->middleware('auth');

// ========== ROUTES DENGAN MIDDLEWARE AUTH ==========
Route::middleware('auth')->group(function () {
    // Profile routes (bisa diakses semua role yang login)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Status routes (bisa diakses semua role yang login)
    Route::get('/statuses', [StatusController::class, 'index'])->name('statuses.index');
});


// ========== MASTER ADMIN ==========
Route::middleware(['auth', CekRole::class . ':Master Admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);

    Route::resource('program-studi', ProgramStudiController::class);

    Route::resource('jenis_surat', JenisSuratController::class);

    Route::get('/admin/dashboard', fn() => view('dashboard'))->name('admin.dashboard');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
});


// ========== TATA USAHA ==========
Route::middleware(['auth', CekRole::class . ':Tata Usaha'])->group(function () {
    Route::get('tatausaha.dashboard', fn() => view('tatausaha.dashboard'))->name('tataUsaha.dashboard');

    // Tambahkan route khusus Tata Usaha jika ada
});

// ========== KEPALA PRODI ==========
Route::middleware(['auth', CekRole::class . ':Kepala Prodi'])->group(function () {
    Route::get('kaprodi/dashboard', fn() => view('kaprodi.dashboard'))->name('kaprodi.dashboard');

    // Tambahkan route khusus Kepala Prodi jika ada
});

// ========== MAHASISWA ==========
Route::middleware(['auth', CekRole::class . ':Mahasiswa'])->group(function () {
    Route::get('mahasiswa/dashboard', fn() => view('dashboard'))->name('mahasiswa.dashboard');
    Route::resource('surat', SuratController::class);
    Route::get('/mahasiswa/dashboard', [SuratController::class, 'index'])->name('mahasiswa.dashboard');
    Route::post('/dokumen_surat', [DokumenSuratController::class, 'store']);
    Route::get('/dokumen_surat/{id}/download', [DokumenSuratController::class, 'download'])->name('dokumen_surat.download');
});

// ========== APPROVAL KHUSUS KEPRODI & TU ==========
Route::middleware(['auth', CekRole::class . ':Kepala Prodi,Tata Usaha'])->post('/approval', [ApprovalController::class, 'store'])->name('approval.store');

// ========== AUTH ROUTES ==========
require __DIR__.'/auth.php';