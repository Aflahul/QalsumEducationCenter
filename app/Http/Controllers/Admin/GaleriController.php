<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::all();
        return view('admin.galeri.index', compact('galeri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fileName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('images'), $fileName);

        Galeri::create([
            'judul' => $request->judul,
            'gambar' => $fileName,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Gambar berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $galeri = Galeri::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $fileName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images'), $fileName);
            $galeri->gambar = $fileName;
        }

        $galeri->judul = $request->judul;
        $galeri->save();

        return redirect()->route('admin.galeri.index')->with('success', 'Gambar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        unlink(public_path('images').'/'.$galeri->gambar);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Gambar berhasil dihapus!');
    }
}
