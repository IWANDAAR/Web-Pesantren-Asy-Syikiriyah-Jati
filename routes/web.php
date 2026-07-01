<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\RiwayatPekerjaanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard (Admin & Pimpinan)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Laporan (Admin & Pimpinan)
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetakPdf'])->name('laporan.cetak');

    // Profile (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Group for Admin Only (Modify routes)
    Route::middleware(['role:admin'])->group(function () {
        // Pegawai CRUD except index & show
        Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
        Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
        Route::get('/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
        Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update');
        Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

        // Jabatan CRUD except index
        Route::get('/jabatan/create', [JabatanController::class, 'create'])->name('jabatan.create');
        Route::post('/jabatan', [JabatanController::class, 'store'])->name('jabatan.store');
        Route::get('/jabatan/{jabatan}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
        Route::put('/jabatan/{jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');
        Route::delete('/jabatan/{jabatan}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');

        // Riwayat Pekerjaan CRUD except index
        Route::get('/riwayat/create', [RiwayatPekerjaanController::class, 'create'])->name('riwayat.create');
        Route::post('/riwayat', [RiwayatPekerjaanController::class, 'store'])->name('riwayat.store');
        Route::get('/riwayat/{riwayat}/edit', [RiwayatPekerjaanController::class, 'edit'])->name('riwayat.edit');
        Route::put('/riwayat/{riwayat}', [RiwayatPekerjaanController::class, 'update'])->name('riwayat.update');
        Route::delete('/riwayat/{riwayat}', [RiwayatPekerjaanController::class, 'destroy'])->name('riwayat.destroy');

        // User CRUD (Admin only)
        Route::resource('user', UserController::class)->except(['show']);
    });

    // Group for Admin & Pimpinan (View Only routes)
    Route::middleware(['role:admin,pimpinan'])->group(function () {
        Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
        Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'show'])->name('pegawai.show');

        Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');

        Route::get('/riwayat', [RiwayatPekerjaanController::class, 'index'])->name('riwayat.index');
    });
});

require __DIR__.'/auth.php';
