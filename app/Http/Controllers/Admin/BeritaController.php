<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::all();
        return view('admin.berita.index', compact('berita'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

         // Buat dan simpan berita
        $berita = new Berita();
        $berita->judul = $validatedData['judul'];
        $berita->konten = $validatedData['konten'];

        // Jika ada gambar, simpan lokasi gambar
        if ($request->hasFile('gambar')) {
            // Bersihkan nama dari spasi atau karakter yang tidak valid untuk nama file
            $nama = str_replace(' ', '-', strtolower($berita->nama));
            $extension = $request->file('gambar')->getClientOriginalExtension(); // Dapatkan ekstensi file
            $filename = 'gambar-' . $nama . '.' . $extension; // Nama file akan menjadi gambar-nama.jpg

            // Simpan file ke folder uploads/berita
            $path = $request->file('gambar')->move(public_path('uploads/berita'), $filename);
            $berita->gambar = 'uploads/berita/' . $filename; // Simpan path ke database
        }
          $berita->save(); // Simpan berita

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:2048',

        ]);

        $berita = Berita::findOrFail($id);

        // Menyimpan nama_lembaga file lama sebelum di-update
        $oldGambar = $berita->gambar;

        // Jika ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($oldGambar && file_exists(public_path($oldGambar))) {
                unlink(public_path($oldGambar)); // Menghapus file lama
            }

            // Buat nama_lembaga file baru
            $nama_lembaga = str_replace(' ', '-', strtolower($berita->nama_lembaga));
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $filename = 'gambar-' . $nama_lembaga . '.' . $extension;

            // Simpan gambar baru
            $request->file('gambar')->move(public_path('uploads/brita'), $filename);
            // Simpan path yang benar ke dalam variabel
            $berita->gambar = 'uploads/berita/' . $filename; // Simpan path yang benar
        } else {
            // Jika tidak ada file baru, tetap simpan nama_lembaga file lama
            $berita->gambar = $oldGambar;
        }

        // Update data
        $berita->judul = $validatedData['judul'];
        $berita->konten = $validatedData['konten'];
        
        
        $berita->save();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
