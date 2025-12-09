<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\UserVerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk user yang belum terverifikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/verification-pending', function () {
        return view('auth.verification-pending');
    })->name('verification.pending');
});

// Route untuk admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // User Management
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/pending', [UserManagementController::class, 'pending'])->name('users.pending');
    Route::post('/users/{id}/verify', [UserManagementController::class, 'verify'])->name('users.verify');
    Route::post('/users/{id}/reject', [UserManagementController::class, 'reject'])->name('users.reject');
    Route::post('/users/{id}/toggle', [UserManagementController::class, 'toggleStatus'])->name('users.toggle');
    Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/verification', [UserVerificationController::class, 'index'])->name('users.verification');
    Route::patch('/users/{user}/verify-toggle', [UserVerificationController::class, 'verify'])->name('users.verify.toggle');
    Route::patch('/users/{user}/unverify', [UserVerificationController::class, 'unverify'])->name('users.unverify');
});

// Route yang memerlukan verifikasi
Route::middleware(['auth', 'verified.user'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Surat Masuk
    Route::prefix('surat-masuk')->name('surat-masuk.')->group(function () {
        Route::get('/', [SuratMasukController::class, 'index'])->name('index');
        Route::get('/create', [SuratMasukController::class, 'create'])->name('create');
        Route::post('/', [SuratMasukController::class, 'store'])->name('store');
        Route::get('/{surat}/edit', [SuratMasukController::class, 'edit'])->name('edit');
        Route::put('/{surat}', [SuratMasukController::class, 'update'])->name('update');
        Route::delete('/{surat}', [SuratMasukController::class, 'destroy'])->name('destroy');
        Route::get('/{surat}', [SuratMasukController::class, 'show'])->name('show');
    });

    // Surat Keluar
    Route::prefix('surat-keluar')->name('surat-keluar.')->group(function () {
        Route::get('/', [SuratKeluarController::class, 'index'])->name('index');
        Route::get('/create', [SuratKeluarController::class, 'create'])->name('create');
        Route::post('/', [SuratKeluarController::class, 'store'])->name('store');
        Route::get('/{surat}/edit', [SuratKeluarController::class, 'edit'])->name('edit');
        Route::put('/{surat}', [SuratKeluarController::class, 'update'])->name('update');
        Route::delete('/{surat}', [SuratKeluarController::class, 'destroy'])->name('destroy');
        Route::get('/{surat}', [SuratKeluarController::class, 'show'])->name('show');
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
