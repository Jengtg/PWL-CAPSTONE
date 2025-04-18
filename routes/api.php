<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DokumenSuratController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {
    // User
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);

    // Surat
    Route::get('/surat', [SuratController::class, 'index']);
    Route::post('/surat', [SuratController::class, 'store']);
    Route::get('/surat/{id}', [SuratController::class, 'show']);

    // Approval
    Route::post('/approval', [ApprovalController::class, 'store']);

    // Dokumen Surat
    Route::post('/dokumen_surat', [DokumenSuratController::class, 'store']);
    Route::get('/dokumen_surat/{id}/download', [DokumenSuratController::class, 'download']);

    // Status
    Route::get('/statuses', [StatusController::class, 'index']);

    // Log Aktivitas
    Route::get('/logs', [LogController::class, 'index']);
});
