<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SelesaiController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\NilaiController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\SyaratController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\PembayaranSiswaController;
use App\Http\Controllers\Admin\InstrukturController;
use App\Http\Controllers\Admin\SertifikatController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Instruktur\JadwalController as InstrukturJadwalController;
use App\Http\Controllers\Instruktur\DashboardController as InstrukturDashboardController;




// Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/password/reset', [AuthController::class, 'showResetForm'])->name('password.request');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.reset');

Route::middleware('auth')->group(function () {
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
    // materi 
    Route::resource('materi', MateriController::class)->names([
        'index' => 'admin.materi.index',
        // 'create' => 'admin.materi.create',
        'store' => 'admin.materi.store',
        // 'show' => 'admin.materi.show',
        // 'edit' => 'admin.materi.edit',
        'update' => 'admin.materi.update',
        'destroy' => 'admin.materi.destroy',
    ]);

    // Routes untuk mengelola kelas
    Route::resource('kelas', KelasController::class)->names([
        'index' => 'admin.kelas.index',
        'store' => 'admin.kelas.store',
        'update' => 'admin.kelas.update',
        'destroy' => 'admin.kelas.destroy',
    ]);
    Route::resource('nilai', NilaiController::class)->names([
        'index' => 'admin.nilai.index',
        'create' => 'admin.nilai.create',
        'store' => 'admin.nilai.store',
        'show' => 'admin.nilai.show',
        'edit' => 'admin.nilai.edit',
        'update' => 'admin.nilai.update',
        'destroy' => 'admin.nilai.destroy',
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
    Route::resource('pembayaran', AdminPembayaranController::class)->names([
        'index' => 'admin.pembayaran.index',
        'store' => 'admin.pembayaran.store',
        'update' => 'admin.pembayaran.update',
        'destroy' => 'admin.pembayaran.destroy',
        // 'inputSiswa' => 'admin.pembayaran.inputSiswa',
    ]);
    Route::get('admin/pembayaran/inputSiswa', [AdminPembayaranController::class])->name('admin.pembayaran.inputSiswa');

   


    // Routes untuk mengelola sertifikat
    Route::resource('sertifikat', SertifikatController::class)->names([
        'index' => 'admin.sertifikat.index',
        'create' => 'admin.sertifikat.create',
        'store' => 'admin.sertifikat.store',
        'show' => 'admin.sertifikat.show',
        'edit' => 'admin.sertifikat.edit',
        'update' => 'admin.sertifikat.update',
        'destroy' => 'admin.sertifikat.destroy',
        
    ]);
    Route::get('/api/siswa/{id}', [SiswaController::class, 'show']);
    // Route::get('/admin/sertifikat/print/{id}', [SertifikatController::class, 'print'])->name('admin.sertifikat.print');
    Route::get('sertifikat/{id_siswa}/print', [SertifikatController::class, 'print'])->name('admin.sertifikat.print'); 
    Route::get('/sertifikat/{id}/preview', [SertifikatController::class, 'preview'])->name('admin.sertifikat.preview');
    Route::resource('profil', ProfilController::class)->names([
        'index' => 'admin.profil.index',
        'store' => 'admin.profil.store',
        'update' => 'admin.profil.update',
        'destroy' => 'admin.profil.destroy',

        
    ]);
    Route::resource('agenda', AgendaController::class)->names([
        'index' => 'admin.agenda.index',
        'store' => 'admin.agenda.store',
        'update' => 'admin.agenda.update',
        'destroy' => 'admin.agenda.destroy',

        
    ]);
    Route::resource('berita', BeritaController::class)->names([
        'index' => 'admin.berita.index',
        'store' => 'admin.berita.store',
        'update' => 'admin.berita.update',
        'destroy' => 'admin.berita.destroy',

        
    ]);
    Route::resource('syarat', SyaratController::class)->names([
        'index' => 'admin.syarat.index',
        'store' => 'admin.syarat.store',
        'update' => 'admin.syarat.update',
        'destroy' => 'admin.syarat.destroy',

        
    ]);
    Route::resource('galeri', GaleriController::class)->names([
        'index' => 'admin.galeri.index',
        'store' => 'admin.galeri.store',
        'update' => 'admin.galeri.update',
        'destroy' => 'admin.galeri.destroy',

        
    ]);


    });
});
   

    

// Route untuk pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran/submit', [PendaftaranController::class, 'store'])->name('pendaftaran.submit');

// Route untuk pembayaran
Route::get('/pembayaran/{siswa_id}', [PendaftaranController::class, 'showPembayaran'])->name('pembayaran.index');
Route::post('/pembayaran/{siswa_id}/submit', [PendaftaranController::class, 'storePembayaran'])->name('pembayaran.submit');
Route::get('/pembayaran/sukses/{siswa_id}', [PendaftaranController::class, 'pembayaranSukses'])->name('pembayaran.sukses');

// Rute untuk Landing Pag

Route::get('', [HomeController::class, 'index'])->name('home');
