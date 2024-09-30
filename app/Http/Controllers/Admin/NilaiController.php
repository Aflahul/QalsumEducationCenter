<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Materi;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Models\PenilaianKelas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {
        if ($request->step == 'selectKelas') {
            $kelas = Kelas::find($request->id_kelas);
            $siswa = Siswa::where('id_jadwal', $kelas->jadwal->first()->id)
                ->whereDoesntHave('penilaianKelas', function ($query) use ($kelas) {
                    $query->where('id_jadwal', $kelas->jadwal->first()->id);
                })
                ->get();
            return view('admin.nilai.select_siswa', compact('kelas', 'siswa'));
        } elseif ($request->step == 'inputNilai') {
            $kelas = Kelas::find($request->id_kelas);
            $siswa = Siswa::find($request->id_siswa);
            $materi = Materi::where('id_kelas', $kelas->id)->get();
            return view('admin.nilai.input_nilai', compact('kelas', 'siswa', 'materi'));
        } elseif ($request->step == 'saveNilai') {
            $request->validate([
                'nilai.*' => 'required|numeric|min:0|max:100',
            ]);

            DB::transaction(function () use ($request) {
                $totalNilai = 0;
                $jumlahMateri = count($request->nilai);

                foreach ($request->nilai as $id_materi => $nilai) {
                    PenilaianKelas::create([
                        'id_siswa' => $request->id_siswa,
                        'id_jadwal' => $request->id_jadwal,
                        'id_materi' => $id_materi,
                        'nilai' => $nilai,
                        'catatan' => $request->catatan[$id_materi] ?? null,
                    ]);
                    $totalNilai += $nilai;
                }

                // Hitung rata-rata nilai
                $rataRataNilai = $totalNilai / $jumlahMateri;

                // Cek status kelulusan
                $status = ($rataRataNilai >= 75 && !in_array(false, array_map(function ($n) {
                    return $n >= 75;
                }, $request->nilai))) ? 'Layak' : 'Belum Layak';

                // Simpan atau perbarui sertifikat
                Sertifikat::updateOrCreate(
                    [
                        'id_siswa' => $request->id_siswa,
                        'id_kelas' => $request->id_kelas,
                    ],
                    [
                        'nilai_akhir' => $rataRataNilai,
                        'status' => $status,
                        'tanggal_penyelesaian' => now(),
                        'nomor_sertifikat' => 'CERT-' . strtoupper(uniqid()),
                    ]
                );
            });

            return redirect()->route('admin.nilai.index')->with('success', 'Penilaian dan sertifikat berhasil disimpan.');
        }
    }

    public function update(Request $request, Nilai $nilai)
    {
        DB::transaction(function () use ($request, $nilai) {
            $totalNilai = 0;
            $jumlahMateri = count($request->nilai);

            foreach ($request->nilai as $penilaianId => $nilaiBaru) {
                $penilaian = PenilaianKelas::find($penilaianId);
                $penilaian->nilai = $nilaiBaru;
                $penilaian->save();
                $totalNilai += $nilaiBaru;
            }

            // Hitung rata-rata nilai
            $rataRataNilai = $totalNilai / $jumlahMateri;

            // Cek status kelulusan
            $status = ($rataRataNilai >= 75 && !in_array(false, array_map(function ($n) {
                return $n >= 75;
            }, $request->nilai))) ? 'Layak' : 'Belum Layak';

            // Perbarui sertifikat
            Sertifikat::updateOrCreate(
                [
                    'id_siswa' => $nilai->id_siswa,
                    'id_kelas' => $nilai->id_kelas,
                ],
                [
                    'nilai_akhir' => $rataRataNilai,
                    'status' => $status,
                    'tanggal_penyelesaian' => now(),
                ]
            );
        });

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai dan sertifikat berhasil diperbarui.');
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
