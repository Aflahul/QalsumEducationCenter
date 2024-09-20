<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class InstrukturController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::where('jabatan', 'instruktur')->get(); // Mengambil hanya pegawai dengan jabatan instruktur
        return view('admin.instruktur.index', compact('pegawai')); // Mengirim data pegawai ke view
        
        
    }

    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        return view('admin.instruktur.edit', compact('pegawai'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'username' => 'required|unique:pegawai',
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'kontak_hp' => 'required',
            'pendidikan_terakhir' => 'required',
            'foto' => 'nullable|image',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
        ]);

        // Menghasilkan pegawai_id
        $lastPegawai = Pegawai::orderBy('id', 'desc')->first();
        $nextId = $lastPegawai ? intval(substr($lastPegawai->pegawai_id, 2)) + 1 : 1;
        $pegawaiId = 'PG' . str_pad($nextId, 5, '0', STR_PAD_LEFT); // Menghasilkan PG00001, PG00002, dll.

        // Buat dan simpan pegawai
        $pegawai = new Pegawai();
        $pegawai->pegawai_id = $pegawaiId; // Pastikan pegawai_id diisi
        $pegawai->username = $validatedData['username'];
        $pegawai->nama = $validatedData['nama'];
        $pegawai->tanggal_lahir = $validatedData['tanggal_lahir'];
        $pegawai->alamat = $validatedData['alamat'];
        $pegawai->kontak_hp = $validatedData['kontak_hp'];
        $pegawai->pendidikan_terakhir = $validatedData['pendidikan_terakhir'];

        // Jika ada foto, simpan lokasi foto
        if ($request->hasFile('foto')) {
            // Bersihkan nama dari spasi atau karakter yang tidak valid untuk nama file
            $nama = str_replace(' ', '-', strtolower($pegawai->nama));
            $extension = $request->file('foto')->getClientOriginalExtension(); // Dapatkan ekstensi file
            $filename = 'foto-' . $nama . '.' . $extension; // Nama file akan menjadi foto-nama.jpg

            // Simpan file ke folder uploads/pegawai
            $path = $request->file('foto')->move(public_path('uploads/pegawai'), $filename);
            $pegawai->foto = 'uploads/pegawai/' . $filename; // Simpan path ke database
        }

        $pegawai->jenis_kelamin = $validatedData['jenis_kelamin'];
        $pegawai->jabatan = $validatedData['jabatan'];
        $pegawai->save(); // Simpan pegawai

        // Simpan pengguna jika jabatan adalah admin
        if ($request->jabatan === 'instruktur') {
            $pengguna = new Pengguna();
            $pengguna->username = $pegawai->username;
            $pengguna->password = bcrypt($pegawai->username); // Set password sama dengan username
            $pengguna->role = 'instruktur';
            $pengguna->nama = $pegawai->nama;
            $pengguna->save();
        }

        // return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
        return redirect()->route('admin.instruktur.index')->with('success', 'Pegawai berhasil ditambahkan.');

    }

    public function destroy($id)
    {
        // Temukan pegawai berdasarkan ID
        $pegawai = Pegawai::findOrFail($id);
        
        // Hapus data pengguna yang terkait jika ada
        $pengguna = Pengguna::where('username', $pegawai->username)->first();
        if ($pengguna) {
            $pengguna->delete(); // Hapus data pengguna
        }

        // Hapus foto pegawai dari storage jika ada
        if ($pegawai->foto && file_exists(public_path($pegawai->foto))) {
            unlink(public_path($pegawai->foto));
        }

        // Hapus data pegawai
        $pegawai->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai dan pengguna terkait berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        // Temukan pegawai berdasarkan ID
        $pegawai = Pegawai::findOrFail($id);
        // Simpan jabatan lama
        $jabatanLama = $pegawai->jabatan;

        // Validasi input
        $validatedData = $request->validate([
            'username' => 'required|unique:pegawai,username,' . $pegawai->id,
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'kontak_hp' => 'required',
            'pendidikan_terakhir' => 'required',
            'foto' => 'nullable|image',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
        ]);

        // Jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pegawai->foto && file_exists(public_path($pegawai->foto))) {
                unlink(public_path($pegawai->foto));
            }

            // Buat nama file baru
            $nama = str_replace(' ', '-', strtolower($pegawai->nama));
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filename = 'foto-' . $nama . '.' . $extension;

            // Simpan foto baru
            $request->file('foto')->move(public_path('uploads/pegawai'), $filename);
            // Simpan path yang benar ke dalam variabel
            $pegawai->foto = 'uploads/pegawai/' . $filename; // Simpan path yang benar
        }

        // Logging untuk membantu debugging
        \Log::info('Jabatan lama: ' . $jabatanLama);
        \Log::info('Jabatan baru: ' . $validatedData['jabatan']);

        // Periksa perubahan jabatan dan kelola data pengguna
        if ($jabatanLama === 'instruktur' && $validatedData['jabatan'] !== 'instruktur') {
        // Hapus data pengguna jika jabatan berubah dari instruktur
            $pengguna = Pengguna::where('username', $pegawai->username)->first();
                if ($pengguna) {
                    $pengguna->delete(); // Hapus data pengguna
                    \Log::info('Pengguna dihapus: ' . $pegawai->username);
                }
            } elseif ($jabatanLama === 'instruktur' && $validatedData['jabatan'] === 'instruktur') {
                // Update data pengguna jika tetap instruktur
                $pengguna = Pengguna::where('username', $pegawai->username)->first();
                if ($pengguna) {
                    $pengguna->username = $validatedData['username']; // Update username jika diubah
                    $pengguna->nama = $validatedData['nama']; // Update nama
                    $pengguna->save();
                    \Log::info('Data pengguna diupdate: ' . $pegawai->username);
                }
            } elseif ($jabatanLama !== 'instruktur' && $validatedData['jabatan'] === 'instruktur') {
                // Buat data pengguna baru jika jabatan berubah menjadi instruktur
                $pengguna = Pengguna::where('username', $pegawai->username)->first();
                if (!$pengguna) {
                    $pengguna = new Pengguna();
                    $pengguna->username = $validatedData['username'];
                    $pengguna->password = bcrypt($pegawai->username); // Set password sama dengan username
                    $pengguna->role = 'instruktur';
                    $pengguna->nama = $validatedData['nama'];
                    $pengguna->save();
                    \Log::info('Pengguna baru dibuat: ' . $pegawai->username);
                }
            }


        // Isi data pegawai satu per satu
        $pegawai->username = $validatedData['username'];
        $pegawai->nama = $validatedData['nama'];
        $pegawai->tanggal_lahir = $validatedData['tanggal_lahir'];
        $pegawai->alamat = $validatedData['alamat'];
        $pegawai->kontak_hp = $validatedData['kontak_hp'];
        $pegawai->pendidikan_terakhir = $validatedData['pendidikan_terakhir'];
        $pegawai->jenis_kelamin = $validatedData['jenis_kelamin'];
        $pegawai->jabatan = $validatedData['jabatan'];

        // Pastikan foto tersimpan dengan benar
        \Log::info('Foto sebelum save: ' . $pegawai->foto);
        \Log::info('Jabatan sebelum save: ' . $pegawai->jabatan);

        $pegawai->save(); // Simpan pegawai

        \Log::info('Foto setelah save: ' . $pegawai->foto);
        \Log::info('Jabatan setelah save: ' . $pegawai->jabatan);

        return redirect()->route('admin.instruktur.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }



}
