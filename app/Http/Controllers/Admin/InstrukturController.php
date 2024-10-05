<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class InstrukturController extends Controller
{
    
    public function destroy($id)
    {
        // Temukan pegawai berdasarkan ID
        $pegawai = Pegawai::findOrFail($id);
        
        // Hapus data pengguna yang terkait jika ada
        $pengguna = Pengguna::where('username', $pegawai->username)->first();
        if ($pengguna) {
            $pengguna->delete(); // Hapus data pengguna
        }

        
        $filePath = public_path($pegawai->foto);
        // dd($filePath, file_exists($filePath)); // Debugging: cek apakah file ada dan tampilkan path

        // Hapus foto pegawai jika ada dan file tersebut benar-benar ada
        if ($pegawai->foto && file_exists($filePath)) {
            unlink($filePath); // Menghapus file foto dari folder
        }// Hapus foto pegawai dari storage jika ada
            

        // Hapus data pegawai
        $pegawai->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.instruktur.index')->with('success', 'Data pegawai dan pengguna terkait berhasil dihapus.');
    }

    public function index()
    {
        $pegawai = Pegawai::with('jadwal.kelas')->where('jabatan', 'instruktur')->get();
        return view('admin.instruktur.index', compact('pegawai'));
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
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        // Menghasilkan pegawai_id
        $lastPegawai = Pegawai::orderBy('id', 'desc')->first();
        $nextId = $lastPegawai ? intval(substr($lastPegawai->pegawai_id, 2)) + 1 : 1;
        $pegawaiId = 'PG' . str_pad($nextId, 5, '0', STR_PAD_LEFT); // Menghasilkan PG00001, PG00002, dll.

        // Buat dan simpan pegawai
        $pegawai = new Pegawai();
        $pegawai->pegawai_id = $pegawaiId;
        $pegawai->username = $validatedData['username'];
        $pegawai->nama = $validatedData['nama'];
        $pegawai->tanggal_lahir = $validatedData['tanggal_lahir'];
        $pegawai->alamat = $validatedData['alamat'];
        $pegawai->kontak_hp = $validatedData['kontak_hp'];
        $pegawai->pendidikan_terakhir = $validatedData['pendidikan_terakhir'];

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $nama = str_replace(' ', '-', strtolower($pegawai->nama));
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filename = 'foto-' . $nama . '.' . $extension;
            $request->file('foto')->move(public_path('uploads/pegawai'), $filename);
            $pegawai->foto = 'uploads/pegawai/' . $filename;
        }

        // Tetapkan jabatan sebagai 'instruktur'
        $pegawai->jenis_kelamin = $validatedData['jenis_kelamin'];
        $pegawai->jabatan = 'instruktur'; // Otomatis menetapkan jabatan sebagai 'instruktur'
        
        $pegawai->save();

        // // Simpan pengguna jika jabatan adalah instruktur
        // $pengguna = new Pengguna();
        // $pengguna->username = $pegawai->username;
        // $pengguna->password = bcrypt($pegawai->username); // Set password sama dengan username
        // $pengguna->role = 'instruktur';
        // $pengguna->nama = $pegawai->nama;
        // $pengguna->save();

        return redirect()->route('admin.instruktur.index')->with('success', 'Instruktur berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // Temukan pegawai berdasarkan ID
        $pegawai = Pegawai::findOrFail($id);
       
        $validatedData = $request->validate([
            'username' => 'required|unique:pegawai,username,' . $pegawai->id,
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'kontak_hp' => 'required',
            'pendidikan_terakhir' => 'required',
            'foto' => 'nullable|image',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            // 'jabatan' => 'required',
        ]);

        // Menyimpan nama file lama sebelum di-update
        $oldFoto = $pegawai->foto;

        // Jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($oldFoto && file_exists(public_path($oldFoto))) {
                unlink(public_path($oldFoto)); // Menghapus file lama
            }

            // Buat nama file baru
            $nama = str_replace(' ', '-', strtolower($pegawai->nama));
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filename = 'foto-' . $nama . '.' . $extension;

            // Simpan foto baru
            $request->file('foto')->move(public_path('uploads/pegawai'), $filename);
            // Simpan path yang benar ke dalam variabel
            $pegawai->foto = 'uploads/pegawai/' . $filename; // Simpan path yang benar
        } else {
            // Jika tidak ada file baru, tetap simpan nama file lama
            $pegawai->foto = $oldFoto;
        }
        
        $pegawai->username = $validatedData['username'];
        $pegawai->nama = $validatedData['nama'];
        $pegawai->tanggal_lahir = $validatedData['tanggal_lahir'];
        $pegawai->alamat = $validatedData['alamat'];
        $pegawai->kontak_hp = $validatedData['kontak_hp'];
        $pegawai->pendidikan_terakhir = $validatedData['pendidikan_terakhir'];
        $pegawai->jenis_kelamin = $validatedData['jenis_kelamin'];
        // $pegawai->jabatan = $validatedData['jabatan'];

        // Pastikan foto tersimpan dengan benar
        \Log::info('Foto sebelum save: ' . $pegawai->foto);
        // \Log::info('Jabatan sebelum save: ' . $pegawai->jabatan);

        $pegawai->save(); // Simpan pegawai

        \Log::info('Foto setelah save: ' . $pegawai->foto);
        // \Log::info('Jabatan setelah save: ' . $pegawai->jabatan);

        return redirect()->route('admin.instruktur.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }



}
