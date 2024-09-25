<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data kelas
        $kelas = Kelas::all();
        $kelas = Kelas::with(['jadwal.siswa'])->get();

        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk membuat kelas baru
        return view('admin.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_kelas' => 'required|string|unique:kelas,nama_kelas',
            'deskripsi' => 'required|string',
            'jenis_kelas' => 'required|in:reguler,private',
            'biaya' => [
                'required',
                'numeric',
                // 'min:80000',
                // function($attribute, $value, $fail) {
                //     if ($value % 50000 != 0) {
                //         $fail('Biaya harus dalam kelipatan Rp 50.000.');
                //     }
                // },
            ],
        ]);

        // Simpan data ke database
        Kelas::create($validated);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mengambil data kelas berdasarkan ID
        $kelas = Kelas::findOrFail($id);

        return view('admin.kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validasi input
    $validated = $request->validate([
        'nama_kelas' => 'required|string|unique:kelas,nama_kelas,' . $id, // Pastikan nama_kelas unik kecuali untuk record yang sedang di-edit
        'deskripsi' => 'required|string',
        'jenis_kelas' => 'required|in:reguler,private',
        'biaya' => [
            'required',
            'numeric',
            // 'min:80000',
            // function ($attribute, $value, $fail) {
            //     if ($value % 50000 != 0) {
            //         $fail('Biaya harus dalam kelipatan Rp 50.000.');
            //     }
            // },
        ],
    ]);

    // Temukan data kelas berdasarkan ID
    $kelas = Kelas::findOrFail($id);

    // Update data kelas
    $kelas->update($validated);

    // Redirect kembali ke halaman kelas dengan pesan sukses
    return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Menghapus data kelas
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
