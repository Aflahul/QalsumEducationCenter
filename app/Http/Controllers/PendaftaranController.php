<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        // Ambil data kelas dan jadwal yang tersedia
        $kelas = Kelas::with(['jadwal', 'materi'])->get();
        
        // Kirim data ke view
        $galeris = Galeri::paginate(8);
         $agendas = Agenda::paginate(6);
         $beritas = Berita::paginate(6); 
       

       // Kirim data ke view
        return view('pendaftaran.index', compact('galeris','kelas','agendas','beritas'));
    }

    public function submit(Request $request)
    {
        // Validasi input data siswa
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'kontak_hp' => 'required|string|max:15',
            'pendidikan_terakhir' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'jadwal_id' => 'required|exists:jadwal,id',
        ]);

        // Simpan data siswa ke tabel siswa
        $siswa = Siswa::create([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'kontak_hp' => $request->kontak_hp,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_jadwal' => $request->jadwal_id,
        ]);

        // Redirect ke halaman pembayaran dengan data siswa yang baru terdaftar
        return redirect()->route('pembayaran.index', ['siswa_id' => $siswa->id]);
    }
}
