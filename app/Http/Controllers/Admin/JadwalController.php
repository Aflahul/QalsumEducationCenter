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
        $request->validate([
            'nama_jadwal' => 'required',
            'nama_kelas' => 'required',
            'instruktur' => 'required',
            'jalur' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // Menyimpan data jadwal baru
        Jadwal::create([
            'nama_jadwal' => $request->nama_jadwal,
            'nama_kelas' => $request->nama_kelas,
            'instruktur' => $request->instruktur,
            'jalur' => $request->jalur,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
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
        $request->validate([
            'nama_jadwal' => 'required',
            'nama_kelas' => 'required',
            'instruktur' => 'required',
            'jalur' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // Memperbarui data jadwal
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'nama_jadwal' => $request->nama_jadwal,
            'nama_kelas' => $request->nama_kelas,
            'instruktur' => $request->instruktur,
            'jalur' => $request->jalur,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
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
