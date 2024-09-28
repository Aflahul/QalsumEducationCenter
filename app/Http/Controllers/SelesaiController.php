<?php

// app/Http/Controllers/SelesaiController.php
namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class SelesaiController extends Controller
{
    public function index($siswa_id)
    {
        // Ambil data siswa berdasarkan ID
        $siswa = Siswa::with(['jadwal.kelas', 'pembayaran'])->findOrFail($siswa_id);
        $galeris = Galeri::paginate(8);
         $agendas = Agenda::paginate(6);
         $kelas = Kelas::all(); 
         $beritas = Berita::paginate(6); 
// Kirim data ke view
        return view('pendaftaran.selesai', compact('siswa','galeris','kelas','agendas','beritas'));
    }
}
