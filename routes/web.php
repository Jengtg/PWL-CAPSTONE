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
    Route::get('kaprodi/dashboard', fn() => view('dashboard'))->name('kaprodi.dashboard');

    Route::get('kaprodi/surat', [ApprovalController::class, 'index'])->name('kaprodi.surat.index');
    Route::post('kaprodi/surat/{id}/approve', [ApprovalController::class, 'approve'])->name('kaprodi.surat.approve');
    Route::post('kaprodi/surat/{id}/reject', [ApprovalController::class, 'reject'])->name('kaprodi.surat.reject');
});




// ========== MAHASISWA ========== 
Route::middleware(['auth', CekRole::class . ':Mahasiswa'])->group(function () {
    // Dashboard untuk Mahasiswa
    Route::get('mahasiswa/dashboard', fn() => view('dashboard'))->name('mahasiswa.dashboard');
    Route::get('/surat/pengajuan', [SuratController::class, 'create'])->name('surat.create');

    Route::get('create', [SuratController::class, 'create'])->name('create');
    
    Route::get('aktif/create', [SuratController::class, 'createAktif'])->name('aktif.create');
    Route::post('aktif', [SuratController::class, 'storeAktif'])->name('aktif.store');

    Route::get('lulus/create', [SuratController::class, 'createLulus'])->name('lulus.create');
    Route::post('lulus', [SuratController::class, 'storeLulus'])->name('lulus.store');

    Route::get('tugas/create', [SuratController::class, 'createTugas'])->name('tugas.create');
    Route::post('tugas', [SuratController::class, 'storeTugas'])->name('tugas.store');

    Route::get('studi/create', [SuratController::class, 'createStudi'])->name('studi.create');
    Route::post('studi', [SuratController::class, 'storeStudi'])->name('studi.store');

    Route::get('/mahasiswa/status', [StatusController::class, 'indexMahasiswa'])->name('mahasiswa.status.index');


    // Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
    // Route::get('/surat', [SuratController::class, 'index'])->name('surat.index'); // Rute untuk halaman index surat
    // Route::post('/surat', [SuratController::class, 'store'])->name('surat.store'); // Rute untuk menyimpan pengajuan surat
    // Route::get('/surat/{id}', [SuratController::class, 'show'])->name('surat.show'); // Rute untuk melihat detail surat
    // Route::get('/surat/download/{id}', [SuratController::class, 'download'])->name('surat.download'); // Rute untuk mendownload surat
    
    // Halaman Pengajuan Surat (index) untuk Mahasiswa
    Route::resource('surat', SuratController::class)->only(['index', 'store']);
});

// ========== APPROVAL KHUSUS KEPRODI & TU ==========
Route::middleware(['auth', CekRole::class . ':Kepala Prodi,Tata Usaha'])->post('/approval', [ApprovalController::class, 'store'])->name('approval.store');
Route::get('mahasiswa/dashboard', fn() => view('dashboard'))->name('mahasiswa.dashboard');
// ========== AUTH ROUTES ==========
require __DIR__.'/auth.php';