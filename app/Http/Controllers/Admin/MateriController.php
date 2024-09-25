<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::with('kelas')->get(); // Ambil semua materi beserta relasinya dengan kelas
        $kelas = Kelas::all(); // Ambil semua kelas untuk dropdown

        return view('admin.materi.index', compact('materi', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_materi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'id_kelas' => 'required|exists:kelas,id', // Validasi untuk id_kelas
        ]);

        Materi::create($request->all());

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_materi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'id_kelas' => 'required|exists:kelas,id', // Validasi untuk id_kelas
        ]);

        $materi = Materi::findOrFail($id);
        $materi->update($request->all());

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}