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

    public function submit(Request $request)
    {
        // Validasi input pembayaran
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'pembayaran' => 'required|numeric|min:1',
            'bukti_pembayaran' => 'required|image|max:2048' // pastikan file yang diupload adalah gambar
        ]);

        // Simpan data pembayaran ke database
        $pembayaran = new Pembayaran();
        $pembayaran->id_siswa = $request->siswa_id;
        $pembayaran->biaya_total = $request->biaya_total;
        $pembayaran->angsuran1 = $request->pembayaran;
        $pembayaran->status = ($request->pembayaran >= $request->biaya_total) ? 'Lunas' : 'Belum Lunas';

        // Upload bukti pembayaran
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('bukti_pembayaran'), $filename);
            $pembayaran->bukti_pembayaran = $filename;
        }

        $pembayaran->save();

        // Redirect ke halaman selesai atau informasi lainnya
        return redirect()->route('pendaftaran.selesai', ['siswa_id' => $pembayaran->id_siswa]);
    }
}
