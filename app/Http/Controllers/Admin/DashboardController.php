<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Pegawai;
use App\Models\Pembayaran;
use App\Models\Sertifikat;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah siswa yang terdaftar
        $jumlah_siswa = Siswa::count();
        $jumlahKelasAktif = Kelas::count();
        $jumlahPegawai = Pegawai::where('jabatan','Instruktur')->count();
       
        // Ambil semua jadwal dengan menghitung jumlah siswa per jadwal
        $jadwal = Jadwal::with('siswa')->get(); // Ambil semua jadwal dengan relasi siswa

        // Siapkan data untuk chart
        $jadwalLabels = $jadwal->pluck('nama_jadwal'); // Ambil nama jadwal
        $jumlahSiswaPerJadwal = $jadwal->map(function($jadwal) {
            return $jadwal->siswa->count(); // Hitung jumlah siswa per jadwal
        });
        // $jumlahKelasAktif = Kelas::count(); // Hitung jumlah kelas aktif
        $jumlahPembayaranLunas = Pembayaran::where('status', 'Lunas')->count(); // Hitung jumlah pembayaran lunas
        $jumlahPembayarantunda = Pembayaran::where('status', 'Belum Lunas')->count(); // Hitung jumlah pembayaran lunas
        $jumlahLulus = Nilai::where('nilai_rata_rata', '>=', 75)->count(); // Hitung jumlah siswa yang lulus
        $jumlahTidakLulus = Nilai::where('nilai_rata_rata', '<', 75)->count(); // Hitung jumlah siswa yang tidak lulus


        // Jumlah pendaftaran baru (misalnya dalam 30 hari terakhir)
        $pendaftaran_baru = Siswa::where('created_at', '>=', now()->subDays(30))->count();

        // Siswa yang telah mendapatkan sertifikat
        $siswa_bersertifikat = Sertifikat::where('status', 'Layak')->count();

        // Daftar pembayaran tertunda
        $pembayaran_tertunda = Pembayaran::with('siswa.jadwal.kelas')
            ->where('status', 'Belum Lunas')
            ->get();

        // Daftar pendaftaran baru
        $pendaftaran_baru_list = Siswa::with('jadwal.kelas')
            ->where('created_at', '>=', now()->subDays(30))
            ->get();

        // Daftar kelas aktif
        $kelas_aktif = Kelas::with('jadwal')
            ->whereHas('jadwal')
            ->get();

        // Kirim data ke view
        return view('admin.dashboard', [
            'jumlah_siswa' => $jumlah_siswa,
            'jadwalLabels' => $jadwalLabels,
            'jumlahKelasAktif' => $jumlahKelasAktif,
            'jumlahPembayaranLunas' => $jumlahPembayaranLunas,
            'jumlahPembayarantunda' => $jumlahPembayarantunda,
            'pendaftaran_baru' => $pendaftaran_baru,
            'siswa_bersertifikat' => $siswa_bersertifikat,
            'pembayaran_tertunda' => $pembayaran_tertunda,
            'pendaftaran_baru_list' => $pendaftaran_baru_list,
            'kelas_aktif' => $kelas_aktif,
            'jumlahLulus'=>$jumlahLulus,
            'jumlahSiswaPerJadwal'=>$jumlahSiswaPerJadwal,
            'jumlahTidakLulus'=>$jumlahTidakLulus,
            'jumlahPegawai'=>$jumlahPegawai,
        ]);
    }
//     public function index()
// {
//     $totalSiswa = Siswa::count();
//     $kelasAktif = Kelas::where('status', 'active')->count();
//     $pembayaranTertunda = Pembayaran::where('status', 'tunda')->count();
//     $pendaftaranBaru = Pendaftaran::where('created_at', '>=', now()->subMonth())->count();
    
//     $pembayaranTerakhir = Pembayaran::with('siswa')->orderBy('created_at', 'desc')->take(5)->get();
//     $pembayaranTertundaList = Pembayaran::with('siswa')->where('sisa_pembayaran', '>', 0)->get();

//     // Data untuk grafik
//     $chartLabels = []; // Tambahkan label bulan atau tahun
//     $chartData = []; // Tambahkan data jumlah pendaftaran

//     return view('admin.dashboard', compact('totalSiswa', 'kelasAktif', 'pembayaranTertunda', 'pendaftaranBaru', 'pembayaranTerakhir', 'pembayaranTertundaList', 'chartLabels', 'chartData'));
// }

}
