<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\PendaftaranKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data siswa dengan relasi ke PendaftaranKelas, Kelas, dan Jadwal
        $siswa = Siswa::with('jadwal.kelas')->get();
        $siswa = Siswa::with('nilai')->get();

        $jadwal = Jadwal::all();  // Ambil semua kelas untuk pilihan saat menambah/edit siswa
        $kelas= Kelas::all();  // Ambil semua kelas untuk pilihan saat menambah/edit siswa

        return view('admin.siswa.index', compact('siswa', 'kelas','jadwal'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'kontak_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'id_jadwal' => 'required|exists:jadwal,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $lastSiswa = Siswa::orderBy('id', 'desc')->first();
        $nextId = $lastSiswa ? intval(substr($lastSiswa->nomor_siswa, 2)) + 1 : 1;
        $nomorSiswa = 'SW' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('uploads/siswa', 'public');
        }

        try {
            Siswa::create([
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'kontak_hp' => $request->kontak_hp,
                'alamat' => $request->alamat,
                'id_jadwal' => $request->id_jadwal, // pastikan ini sesuai
                'nomor_siswa' => $nomorSiswa,
                'foto' => $foto ? basename($foto) : null,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan.');

    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'kontak_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Cari siswa berdasarkan id
        $siswa = Siswa::findOrFail($id);

        // Update foto siswa jika ada file baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto && Storage::disk('public')->exists('uploads/siswa/' . $siswa->foto)) {
                Storage::disk('public')->delete('uploads/siswa/' . $siswa->foto);
            }

            // Upload foto baru
            $foto = $request->file('foto')->store('uploads/siswa', 'public');
            $siswa->foto = basename($foto);
        }

        // Update data siswa
        $siswa->update([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kontak_hp' => $request->kontak_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari siswa berdasarkan id
        $siswa = Siswa::findOrFail($id);

        // Hapus foto siswa jika ada
        if ($siswa->foto && Storage::disk('public')->exists('uploads/siswa/' . $siswa->foto)) {
            Storage::disk('public')->delete('uploads/siswa/' . $siswa->foto);
        }

        // Hapus siswa dari database
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
