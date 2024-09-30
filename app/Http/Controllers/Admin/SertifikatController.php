<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SertifikatController extends Controller
{
    public function index()
    {
        // Ambil semua data siswa beserta relasi yang diperlukan
        $siswa = Siswa::with(['kelas', 'sertifikat', 'nilai'])->get();

        // Return ke view index sertifikat
        return view('admin.sertifikat.index', compact('siswa'));
    }

 

    public function show($id)
    {
        $sertifikat = Sertifikat::find($id);
        return view('admin.sertifikat.show', compact('sertifikat'));
    }
    public function selectKelas(Request $request)
{
    $request->validate([
        'id_kelas' => 'required|exists:kelas,id',
    ]);

    // Ambil siswa yang telah dinilai di kelas tersebut
    $kelas = Kelas::find($request->id_kelas);

    // Cari siswa yang memiliki nilai akhir
    $siswa = Siswa::whereHas('nilai', function($query) use ($kelas) {
        $query->where('id_kelas', $kelas->id);
    })->get();

    return view('admin.sertifikat.select_siswa', compact('kelas', 'siswa'));
}
public function createSertifikat(Request $request)
{
    $request->validate([
        'id_kelas' => 'required|exists:kelas,id',
        'id_siswa' => 'required|exists:siswa,id',
    ]);

    $siswa = Siswa::find($request->id_siswa);
    $kelas = Kelas::find($request->id_kelas);
    
    // Menampilkan nilai akhir siswa di kelas ini
    $nilai_akhir = $siswa->nilai->where('id_kelas', $kelas->id)->first()->nilai_rata_rata;

    return view('admin.sertifikat.confirm', compact('siswa', 'kelas', 'nilai_akhir'));
}
public function store(Request $request)
{
    $request->validate([
        'id_siswa' => 'required|exists:siswa,id',
        'id_kelas' => 'required|exists:kelas,id',
        'nilai_akhir' => 'required|numeric|min:0|max:100',
    ]);

    Sertifikat::create([
        'id_siswa' => $request->id_siswa,
        'id_kelas' => $request->id_kelas,
        'nilai_akhir' => $request->nilai_akhir,
        'tanggal_terbit' => now(),
    ]);

    return redirect()->route('admin.sertifikat.index')->with('success', 'Sertifikat berhasil diterbitkan.');
}

public function preview($id)
{
    $siswa = Siswa::with('jadwal.kelas', 'penilaianKelas.materi', 'nilai')->findOrFail($id);

    return view('admin.sertifikat.preview', compact('siswa'));
}

   // Fungsi untuk mencetak sertifikat sebagai PDF
   public function print($id_siswa)
{
    // Cari siswa berdasarkan ID dan load relasinya
    $siswa = Siswa::with(['kelas', 'sertifikat', 'penilaianKelas.materi',])->findOrFail($id_siswa);

    // Return view sertifikat dan kirim data siswa
    return view('admin.sertifikat.print', compact('siswa'));
}


}
