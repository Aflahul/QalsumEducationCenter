<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
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
        $kelas = Kelas::all();
        $siswa = Siswa::with(['nilai', 'penilaianKelas.materi', 'jadwal.kelas'])->get();
        return view('admin.nilai.index', compact('siswa','materi','kelas'));
    }

    public function update(Request $request, Nilai $nilai)
{
    foreach ($request->nilai as $penilaianId => $nilaiBaru) {
        $penilaian = PenilaianKelas::find($penilaianId);
        $penilaian->nilai = $nilaiBaru;
        $penilaian->save();
    }

    return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil diperbarui');
}

    public function store(Request $request)
{
    if ($request->step == 'selectKelas') {
        // Mendapatkan kelas berdasarkan id
        $kelas = Kelas::find($request->id_kelas);
        
        // Mendapatkan siswa yang belum dinilai di kelas ini
        $siswa = Siswa::where('id_jadwal', $kelas->jadwal->first()->id)
            ->whereDoesntHave('penilaianKelas', function ($query) use ($kelas) {
                $query->where('id_jadwal', $kelas->jadwal->first()->id);
            })
            ->get();
        
        return view('admin.nilai.select_siswa', compact('kelas', 'siswa'));
    } elseif ($request->step == 'inputNilai') {
        // Menampilkan form input nilai
        $kelas = Kelas::find($request->id_kelas);
        $siswa = Siswa::find($request->id_siswa);

        // Mendapatkan materi yang terhubung dengan kelas
        $materi = Materi::where('id_kelas', $kelas->id)->get();

        return view('admin.nilai.input_nilai', compact('kelas', 'siswa', 'materi'));
    } elseif ($request->step == 'saveNilai') {
        // Simpan nilai ke database
        $request->validate([
    'nilai.*' => 'required|numeric|min:0|max:100',
]);

        foreach ($request->nilai as $id_materi => $nilai) {
            PenilaianKelas::create([
                'id_siswa' => $request->id_siswa,
                'id_jadwal' => $request->id_jadwal,
                'id_materi' => $id_materi,
                'nilai' => $nilai,
                'catatan' => $request->catatan[$id_materi] ?? null,
            ]);
        }

        return redirect()->route('admin.nilai.index')->with('success', 'Penilaian berhasil disimpan.');
    }
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
 public function create()
{
    $kelas = Kelas::all(); // Mendapatkan semua kelas
    return view('admin.nilai.create', compact('kelas'));
}


}
