<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profil;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Profil::first();
        return view('admin.profil.lembaga.index', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        
        // Validasi data
         $validatedData = $request->validate([
            'nama_lembaga' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'telepon' => 'required',
            'deskripsi' => 'required',
            'logo' => 'nullable|image|max:2048',
        ]);
        $profil = Profil::findOrFail($id);

        // Menyimpan nama_lembaga file lama sebelum di-update
        $oldLogo = $profil->logo;

        // Jika ada file logo yang diupload
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($oldLogo && file_exists(public_path($oldLogo))) {
                unlink(public_path($oldLogo)); // Menghapus file lama
            }

            // Buat nama_lembaga file baru
            $nama_lembaga = str_replace(' ', '-', strtolower($profil->nama_lembaga));
            $extension = $request->file('logo')->getClientOriginalExtension();
            $filename = 'logo-' . $nama_lembaga . '.' . $extension;

            // Simpan logo baru
            $request->file('logo')->move(public_path('uploads/logo'), $filename);
            // Simpan path yang benar ke dalam variabel
            $profil->logo = 'uploads/logo/' . $filename; // Simpan path yang benar
        } else {
            // Jika tidak ada file baru, tetap simpan nama_lembaga file lama
            $profil->logo = $oldLogo;
        }

        // Update data
        $profil->nama_lembaga = $validatedData['nama_lembaga'];
        $profil->alamat = $validatedData['alamat'];
        $profil->email = $validatedData['email'];
        $profil->telepon = $validatedData['telepon'];
        $profil->deskripsi = $validatedData['deskripsi'];

        
        $profil->save();
        

        return redirect()->route('admin.profil.index')->with('success', 'Profil lembaga berhasil diperbarui.');
    }
}
