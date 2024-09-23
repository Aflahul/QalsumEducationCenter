<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\InstrukturController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\SertifikatController;
use App\Http\Controllers\Instruktur\NilaiController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Instruktur\JadwalController as InstrukturJadwalController;
use App\Http\Controllers\Instruktur\DashboardController as InstrukturDashboardController;

// Route untuk halaman utama (home)
Route::get('/', function () {
    return view('home.index');
});

// Route untuk admin dashboard
// Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

//     // Routes untuk mengelola pegawai
//     Route::resource('pegawai', PegawaiController::class);

//     // Routes untuk mengelola siswa
//     Route::resource('siswa', SiswaController::class)->only(['index', 'show']);

//     // Routes untuk mengelola kelas
//     Route::resource('kelas', KelasController::class);

//     // Routes untuk mengelola jadwal
//     Route::resource('jadwal', AdminJadwalController::class)->only(['index', 'edit', 'update']);

//     // Routes untuk mengelola pembayaran
//     Route::resource('pembayaran', PembayaranController::class)->only(['index', 'show']);

//     // Routes untuk mengelola sertifikat
//     Route::resource('sertifikat', SertifikatController::class)->only(['index', 'show']);
// });

// // Route untuk instruktur dashboard
// Route::prefix('instruktur')->middleware(['auth', 'role:instruktur'])->group(function () {
//     Route::get('/dashboard', [InstrukturDashboardController::class, 'index'])->name('instruktur.dashboard');

//     // Routes untuk mengelola nilai
//     Route::resource('nilai', NilaiController::class)->only(['index', 'edit', 'update']);

//     // Routes untuk melihat dan mengedit jadwal
//     Route::resource('jadwal', InstrukturJadwalController::class)->only(['index', 'edit', 'update']);
// });
//============================================================================================

// Rute untuk admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Routes untuk mengelola staf
    Route::resource('staff', PegawaiController::class)->names([
        'index' => 'admin.pegawai.index',
        'create' => 'admin.pegawai.create',
        'store' => 'admin.pegawai.store',
        'show' => 'admin.pegawai.show',
        'edit' => 'admin.pegawai.edit',
        'update' => 'admin.pegawai.update',
        'destroy' => 'admin.pegawai.destroy',
    ]);
    // Routes untuk mengelola Instruktur
    Route::resource('instruktur', InstrukturController::class)->names([
        'index' => 'admin.instruktur.index',
        'create' => 'admin.instruktur.create',
        'store' => 'admin.instruktur.store',
        'show' => 'admin.instruktur.show',
        'edit' => 'admin.instruktur.edit',
        'update' => 'admin.instruktur.update',
        'destroy' => 'admin.instruktur.destroy',
    ]);
    

    // Routes untuk mengelola siswa
    Route::resource('siswa', SiswaController::class)->names([
        'index' => 'admin.siswa.index',
        // 'create' => 'admin.siswa.create',
        'store' => 'admin.siswa.store',
        // 'show' => 'admin.siswa.show',
        // 'edit' => 'admin.siswa.edit',
        'update' => 'admin.siswa.update',
        'destroy' => 'admin.siswa.destroy',
    ]);

    // Routes untuk mengelola kelas
    Route::resource('kelas', KelasController::class)->names([
        'index' => 'admin.kelas.index',
        'store' => 'admin.kelas.store',
        'update' => 'admin.kelas.update',
        'destroy' => 'admin.kelas.destroy',
    ]);

    // Routes untuk mengelola jadwal
    Route::resource('jadwal', AdminJadwalController::class)->names([
        'index' => 'admin.jadwal.index',
        'create' => 'admin.jadwal.create',
        'store' => 'admin.jadwal.store',
        'show' => 'admin.jadwal.show',
        'edit' => 'admin.jadwal.edit',
        'update' => 'admin.jadwal.update',
        'destroy' => 'admin.jadwal.destroy',
    ]);

    // Routes untuk mengelola pembayaran
    Route::resource('pembayaran', PembayaranController::class)->names([
        'index' => 'admin.pembayaran.index',
        'show' => 'admin.pembayaran.show',
    ]);

    // Routes untuk mengelola sertifikat
    Route::resource('sertifikat', SertifikatController::class)->names([
        'index' => 'admin.sertifikat.index',
        'show' => 'admin.sertifikat.show',
    ]);
});

// Rute untuk instruktur
Route::prefix('instruktur')->group(function () {
    Route::get('/dashboard', [InstrukturDashboardController::class, 'index'])->name('instruktur.dashboard');

    // Routes untuk mengelola nilai
    Route::resource('nilai', NilaiController::class)->names([
        'index' => 'instruktur.nilai.index',
        'edit' => 'instruktur.nilai.edit',
        'update' => 'instruktur.nilai.update',
    ]);

    // Routes untuk melihat dan mengedit jadwal
    Route::resource('jadwal', InstrukturJadwalController::class)->names([
        'index' => 'instruktur.jadwal.index',
        'edit' => 'instruktur.jadwal.edit',
        'update' => 'instruktur.jadwal.update',
    ]);
});



// Route untuk halaman pendaftaran siswa
Route::get('pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('pendaftaran/confirm', [PendaftaranController::class, 'confirm'])->name('pendaftaran.confirm');

// Authentication Routes
Auth::routes();

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
