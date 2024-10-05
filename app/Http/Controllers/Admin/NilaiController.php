<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Materi;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Models\PenilaianKelas;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NilaiController extends Controller
{
    public function index()
        {
            // Mengambil data siswa beserta nilai, kelas, dan jadwal
            $materi = Materi::all();
            $kelas = Kelas::all();
            $siswa = Siswa::with(['nilai', 'penilaianKelas.materi', 'jadwal.kelas'])->get();
            return view('admin.nilai.index', compact('siswa', 'materi', 'kelas'));
        }

        public function update(Request $request, $id_siswa)
    {
        // Ambil data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($id_siswa);

        // Ambil semua penilaian dari request dan update di PenilaianKelas
        foreach ($request->input('penilaian') as $id_penilaian => $input) {
            $penilaian = PenilaianKelas::find($id_penilaian);
            if ($penilaian) {
                $penilaian->nilai = $input['nilai'];
                $penilaian->catatan = $input['catatan'] ?? null;
                $penilaian->save();
            }
        }

        // Hitung nilai total dan nilai rata-rata berdasarkan penilaian kelas
        $nilaiTotal = $siswa->penilaianKelas->where('id_kelas', $siswa->jadwal->id_kelas)->sum('nilai');
        $nilaiRataRata = $siswa->penilaianKelas->where('id_kelas', $siswa->jadwal->id_kelas)->avg('nilai');

        // Update tabel `nilai`
        $nilaiSiswa = Nilai::where('id_siswa', $id_siswa)
                            ->where('id_kelas', $siswa->jadwal->id_kelas)
                            ->first();

        if ($nilaiSiswa) {
            $nilaiSiswa->nilai_total = $nilaiTotal;
            $nilaiSiswa->nilai_rata_rata = $nilaiRataRata;
            $nilaiSiswa->grade = $this->hitungGrade($nilaiRataRata);
            $nilaiSiswa->save();
        }

        // Update tabel `sertifikat`
        $sertifikat = Sertifikat::where('id_siswa', $id_siswa)
                                ->where('id_kelas', $siswa->jadwal->id_kelas)
                                ->first();

        if ($sertifikat) {
            $sertifikat->nilai_akhir = $nilaiRataRata;
            $sertifikat->status = $nilaiRataRata >= 75 ? 'Layak' : 'Belum Layak';

            // Update nomor sertifikat, bisa menggunakan logika tertentu untuk penentuan nomor
            $sertifikat->nomor_sertifikat = $this->generateNomorSertifikat($siswa->id);
            $sertifikat->save();
        }

        return redirect()->back()->with('success', 'Data penilaian berhasil diperbarui.');
    }

    // Fungsi untuk menghitung grade berdasarkan nilai rata-rata
    private function hitungGrade($nilai)
    {
        if ($nilai >= 85) {
            return 'A';
        } elseif ($nilai >= 75) {
            return 'B';
        } elseif ($nilai >= 60) {
            return 'C';
        } else {
            return 'D';
        }
    }

    // Fungsi untuk menghasilkan nomor sertifikat baru
    private function generateNomorSertifikat($id_siswa)
    {
        // Contoh logika untuk menghasilkan nomor sertifikat
        return 'SERTIFIKAT-' . strtoupper(dechex($id_siswa)) . '-' . date('Y');
    }

    public function destroy($id)
    {
        $penilaian = PenilaianKelas::findOrFail($id);
        $penilaian->delete();
        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }

    public function create()
{
    // Mengambil siswa yang belum memiliki penilaian
    $siswa = Siswa::whereDoesntHave('penilaianKelas')->with('jadwal.kelas')->get();
    $materi = Materi::all();

    return view('admin.nilai.create', compact('siswa', 'materi'));
}
}
