<?php

// app/Http/Controllers/PembayaranController.php
namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Jadwal;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranSiswaController extends Controller
{
    public function index($siswa_id)
    {
        // Ambil data siswa berdasarkan ID
        $siswa = Siswa::with(['jadwal.kelas'])->findOrFail($siswa_id);
         
        // Hitung total biaya berdasarkan kelas
         $biaya_total = $siswa->jadwal->kelas->biaya;
         $galeris = Galeri::paginate(8);
         $agendas = Agenda::paginate(6);
         $kelas = Kelas::all(); 
         $beritas = Berita::paginate(6); 

        // Kirim data ke view
        return view('pembayaran.index', compact('siswa', 'biaya_total','galeris','kelas','agendas','beritas' ));
    }

    
}
