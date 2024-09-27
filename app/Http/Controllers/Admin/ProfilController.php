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
        $profil = Profil::findOrFail($id);

        // Validasi data
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'telepon' => 'required',
            'deskripsi' => 'required',
            'logo' => 'nullable|image|max:2048',
        ]);

        // Update data
        $profil->update($request->except('logo'));

        // Update logo jika diunggah
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $profil->logo = $path;
            $profil->save();
        }

        return redirect()->route('admin.profil.index')->with('success', 'Profil lembaga berhasil diperbarui.');
    }
}
