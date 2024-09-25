<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = Sertifikat::all();
        return view('admin.sertifikat.index', compact('sertifikat'));
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

}
