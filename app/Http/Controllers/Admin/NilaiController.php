<?php

namespace App\Http\Controllers\Admin;

use App\Models\Siswa;
use App\Models\Materi;
use Illuminate\Http\Request;
use App\Models\PenilaianKelas;
use App\Http\Controllers\Controller;

class NilaiController extends Controller
{
    public function index()
    {
        // Mengambil data siswa beserta nilai, kelas, dan jadwal
        $materi= Materi::all();
        $siswa = Siswa::with(['nilai', 'penilaianKelas.materi', 'jadwal.kelas'])->get();
        return view('admin.nilai.index', compact('siswa','materi'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nilai.*' => 'required|numeric|min:0|max:100',
        ]);

        // Update setiap penilaian materi siswa
        foreach ($request->nilai as $penilaianId => $nilai) {
            $penilaian = PenilaianKelas::find($penilaianId);
            if ($penilaian) {
                $penilaian->nilai = $nilai;
                $penilaian->catatan = $request->catatan[$penilaianId] ?? null;
                $penilaian->save();
            }
        }

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil diperbarui.');
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id',
            'nilai.*' => 'required|numeric|min:0|max:100',
        ]);

        // Loop untuk menyimpan nilai ke dalam database per materi
        foreach ($request->nilai as $materiId => $nilai) {
            PenilaianKelas::create([
                'id_siswa' => $request->id_siswa,
                'id_materi' => $materiId,
                'nilai' => $nilai,
                'catatan' => $request->catatan[$materiId] ?? null,
            ]);
        }

        // Redirect ke halaman utama dengan pesan sukses
        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil ditambahkan.');
    }
    public function destroy($id)
    {
        // Cari penilaian berdasarkan id
        $penilaian = PenilaianKelas::findOrFail($id);

        // Hapus penilaian tersebut
        $penilaian->delete();

        // Redirect ke halaman utama dengan pesan sukses
        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }

}
