<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
// use App\Models\Kelas;  
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\PendaftaranKelas;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    public function index()
    {
        // Mengambil data siswa dengan relasi ke pendaftaran kelas, jadwal, kelas, dan pembayaran
        $siswa = Siswa::with([
            'pendaftaranKelas.jadwal.kelas',  // Mengambil kelas melalui jadwal
            'pendaftaranKelas.pembayaran'     // Mengambil pembayaran melalui pendaftaran kelas
        ])->get();

        // Mengambil data kelas untuk modal edit, agar admin bisa menambah atau mengedit kelas
        $kelas = Kelas::all();
         // Mengambil data jadwal untuk modal pemilihan jadwal
        $jadwal = Jadwal::with('kelas')->get();
        

        return view('admin.siswa.index', compact('siswa', 'kelas', 'jadwal'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:500',
            'kontak_hp' => 'required|string|max:15',
            'pendidikan_terakhir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk foto
        ]);

        // Simpan foto
        $fotoPath = $request->file('foto')->storeAs('uploads/siswa', 'foto-' . $request->nama . '.' . $request->foto->extension());

        // Simpan data siswa
        Siswa::create([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'kontak_hp' => $request->kontak_hp,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $fotoPath, // Menyimpan path foto
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show($id)
    {
        // Menampilkan detail siswa berdasarkan ID
        $siswa = Siswa::with(['pendaftaranKelas.jadwal.kelas', 'pendaftaranKelas.pembayaran'])->findOrFail($id);
        return response()->json($siswa);
    }
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'kontak_hp' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'jenis_kelamin' => 'required|string',
        ]);

        // Update data siswa
        $siswa->update($request->only([
            'nama', 'tanggal_lahir', 'alamat', 'kontak_hp', 'pendidikan_terakhir', 'jenis_kelamin'
        ]));

        // Redirect kembali ke halaman daftar siswa
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }
    public function updateKelas(Request $request, Siswa $siswa)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'jadwal_id' => 'required|exists:jadwals,id',
        ]);

        // Cek apakah siswa sudah terdaftar di kelas yang dipilih
        $pendaftaran = PendaftaranKelas::where('siswa_id', $siswa->id)
                        ->where('jadwal_id', $request->jadwal_id)
                        ->first();

        if (!$pendaftaran) {
            // Jika belum terdaftar, tambahkan siswa ke kelas
            PendaftaranKelas::create([
                'siswa_id' => $siswa->id,
                'jadwal_id' => $request->jadwal_id,
            ]);
        }

        // Redirect ke halaman daftar siswa dengan pesan sukses
        return redirect()->route('admin.siswa.index')->with('success', 'Kelas dan jadwal siswa berhasil diperbarui.');
    }
    // Method untuk menyimpan kelas dan jadwal yang dipilih
    public function pilihKelas(Request $request, $id)
    {
        $request->validate(['kelas_id' => 'required|exists:kelas,id']);

        // Simpan kelas yang dipilih (implementasi sesuai kebutuhan)
        // Misalnya, simpan ke pendaftaranKelas atau sesuai model yang digunakan

        // Ambil jadwal terkait kelas
        $jadwals = Jadwal::where('kelas_id', $request->kelas_id)->get();

        return response()->json(['jadwals' => $jadwals]);
    }


}
