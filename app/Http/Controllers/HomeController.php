<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Jadwal;
use App\Models\Profil;
use App\Models\Syarat;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $jumlahSiswa = Siswa::count(); // Hitung jumlah siswa
         $galeris = Galeri::all(); 
         $agendas = Agenda::all(); 
         $profile = Profil::first();
         $syarat = Syarat::first();
         $beritas = Berita::all(); 
         $jumlahPegawai = Pegawai::where('jabatan', 'instruktur')->count();
         $jumlahKelas = Kelas::count(); 
          $jadwals = Jadwal::with(['kelas', 'siswa'])->get();
        return view('home.index', compact(
            'jumlahSiswa','jumlahPegawai','jumlahKelas','jadwals',
            'agendas',
            'galeris',
            'beritas',
            'profile',
            'syarat'

        ));
    }
}
