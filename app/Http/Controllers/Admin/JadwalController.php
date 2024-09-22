<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // Menampilkan halaman daftar jadwal
    public function index()
    {
        $jadwal = Jadwal::all(); // Mendapatkan semua data jadwal
        $kelas = Kelas::all();   // Mendapatkan semua data kelas
        $instruktur = Pegawai::where('jabatan', 'instruktur')->get(); // Mengambil data pegawai yang berperan sebagai instruktur

        return view('admin.jadwal.index', compact('jadwal', 'kelas', 'instruktur'));
    }

    // Menyimpan data jadwal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jadwal' => 'required',
            'id_kelas' => 'required|exists:kelas,id',  // Validasi id_kelas dari kelas
            'id_pegawai' => 'required|exists:pegawai,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // Menyimpan data jadwal baru
        Jadwal::create([
            'nama_jadwal' => $validated['nama_jadwal'],  // Gunakan $validated
            'id_kelas' => $validated['id_kelas'], 
            'id_pegawai' => $validated['id_pegawai'],
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    // Menampilkan halaman edit jadwal
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $kelas = Kelas::all();
        $instruktur = Pegawai::where('jabatan', 'instruktur')->get();

        return view('admin.jadwal.edit', compact('jadwal', 'kelas', 'instruktur'));
    }

    // Memperbarui data jadwal
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_jadwal' => 'required',
            'id_kelas' => 'required|exists:kelas,id',  // Validasi id_kelas dari kelas
            'id_pegawai' => 'required|exists:pegawai,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // Temukan jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Update data jadwal
        $jadwal->update([
            'nama_jadwal' => $validated['nama_jadwal'],  // Gunakan $validated
            'id_kelas' => $validated['id_kelas'], 
            'id_pegawai' => $validated['id_pegawai'],
            'hari' => $validated['hari'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }


    // Menghapus data jadwal
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}
