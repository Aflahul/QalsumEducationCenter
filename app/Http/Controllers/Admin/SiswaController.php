<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\Pembayaran;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Models\PenilaianKelas;
use App\Models\PendaftaranKelas;
use App\Http\Controllers\Controller;
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
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'kontak_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'id_jadwal' => 'required|exists:jadwal,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Ambil ID kelas dari jadwal yang dipilih
        $jadwal = Jadwal::findOrFail($validatedData['id_jadwal']);
        $kelasId = $jadwal->id_kelas;
        
        // Ambil biaya dari kelas
        $kelas = Kelas::findOrFail($kelasId);
        $biayaTotal = $kelas->biaya; // Ambil biaya dari kelas

        $lastSiswa = Siswa::orderBy('id', 'desc')->first();
        $nextId = $lastSiswa ? intval(substr($lastSiswa->nomor_siswa, 2)) + 1 : 1;
        $siswaId = 'SW' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        // Buat dan simpan siswa
        $siswa = new Siswa();
        $siswa->nomor_siswa = $siswaId; // Pastikan siswa_id diisi
        $siswa->nama = $validatedData['nama'];
        $siswa->id_jadwal = $validatedData['id_jadwal'];
        $siswa->tanggal_lahir = $validatedData['tanggal_lahir'];
        $siswa->alamat = $validatedData['alamat'];
        $siswa->kontak_hp = $validatedData['kontak_hp'];
        $siswa->pendidikan_terakhir = $validatedData['pendidikan_terakhir'];
        $siswa->jenis_kelamin = $validatedData['jenis_kelamin'];

        // Jika ada foto, simpan lokasi foto
        if ($request->hasFile('foto')) {
            // Bersihkan nama dari spasi atau karakter yang tidak valid untuk nama file
            $nama = str_replace(' ', '-', strtolower($siswa->nama));
            $extension = $request->file('foto')->getClientOriginalExtension(); // Dapatkan ekstensi file
            $filename = 'foto-' . $nama . '.' . $extension; // Nama file akan menjadi foto-nama.jpg

            // Simpan file ke folder uploads/siswa
            $path = $request->file('foto')->move(public_path('uploads/siswa'), $filename);
            $siswa->foto = 'uploads/siswa/' . $filename; // Simpan path ke database
        }

        $siswa->save(); // Simpan siswa

        // Buat entri pembayaran untuk siswa yang baru dibuat
        Pembayaran::create([
            'id_siswa' => $siswa->id,
            'biaya_total' => $biayaTotal,
            'angsuran1' => 0, // Sesuaikan jika ada nilai default
            'angsuran2' => 0, // Sesuaikan jika ada nilai default
            'sisa_pembayaran' => $biayaTotal, // Total biaya sebagai sisa pembayaran
            'bukti' => null, // Atur jika ada upload bukti
            'status' => 'Belum Ada Pembayaran', // Atur status default sesuai kebutuhan
        ]);

        // Ambil semua materi yang terkait dengan kelas siswa
        $materiKelas = Materi::where('id_kelas', $siswa->jadwal->id_kelas)->get();

        // Loop melalui setiap materi dan buat entri di tabel PenilaianKelas
        foreach ($materiKelas as $materi) {
            PenilaianKelas::create([
                'id_siswa' => $siswa->id,
                'id_kelas' => $siswa->jadwal->id_kelas,
                'id_materi' => $materi->id,
                'nilai' => 0, // Nilai default
                'catatan' => 'Belum ada penilaian', // Catatan default
            ]);
        }

        // Inisialisasi data nilai di tabel Nilai
        Nilai::create([
            'id_siswa' => $siswa->id,
            'id_kelas' => $siswa->jadwal->id_kelas,
            'nilai_total' => 0, // Nilai default
            'nilai_rata_rata' => 0, // Nilai rata-rata default
            'grade' => null, // Grade default
        ]);

        // Inisialisasi data sertifikat di tabel Sertifikat
        Sertifikat::create([
            'id_siswa' => $siswa->id,
            'id_kelas' => $siswa->jadwal->id_kelas,
            'nilai_akhir' => 0, // Nilai akhir default
            'tanggal_penyelesaian' => null, // Tanggal penyelesaian kosong pada awalnya
            'nomor_sertifikat' => null, // Nomor sertifikat diisi nanti
            'status' => 'Belum Layak', // Status default
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        // Cari siswa berdasarkan id
        $siswa = Siswa::findOrFail($id);
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'kontak_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Menyimpan nama file lama sebelum di-update
        $oldFoto = $siswa->foto;

        // Jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($oldFoto && file_exists(public_path($oldFoto))) {
                unlink(public_path($oldFoto)); // Menghapus file lama
            }

            // Buat nama file baru
            $nama = str_replace(' ', '-', strtolower($siswa->nama));
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filename = 'foto-' . $nama . '.' . $extension;

            // Simpan foto baru
            $request->file('foto')->move(public_path('uploads/siswa'), $filename);
            // Simpan path yang benar ke dalam variabel
            $siswa->foto = 'uploads/siswa/' . $filename; // Simpan path yang benar
        } else {
            // Jika tidak ada file baru, tetap simpan nama file lama
            $siswa->foto = $oldFoto;
        }

        // Isi data siswa satu per satu
        $siswa->nama = $validatedData['nama'];
        $siswa->tanggal_lahir = $validatedData['tanggal_lahir'];
        $siswa->alamat = $validatedData['alamat'];
        $siswa->kontak_hp = $validatedData['kontak_hp'];
        $siswa->pendidikan_terakhir = $validatedData['pendidikan_terakhir'];
        $siswa->jenis_kelamin = $validatedData['jenis_kelamin'];
    

       
        $siswa->save(); // Simpan siswa

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
{
    // Cari siswa berdasarkan id
    $siswa = Siswa::findOrFail($id);

    // Debug: cek path file yang ingin dihapus
    $filePath = public_path($siswa->foto);
    // dd($filePath, file_exists($filePath)); // Debugging: cek apakah file ada dan tampilkan path

    // Hapus foto siswa jika ada dan file tersebut benar-benar ada
    if ($siswa->foto && file_exists($filePath)) {
        unlink($filePath); // Menghapus file foto dari folder
    }

    // Hapus siswa dari database
    $siswa->delete();

    return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus beserta foto.');
}



    
}
