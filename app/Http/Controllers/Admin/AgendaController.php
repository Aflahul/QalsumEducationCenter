<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    // Menampilkan halaman index agenda
    public function index()
    {
        $agendas = Agenda::all(); // Mengambil semua data agenda
        return view('admin.agenda.index', compact('agendas')); // Mengirim data ke view
    }

    // Menyimpan agenda baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        // Menyimpan data agenda baru
        Agenda::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan!');
    }

    // Mengupdate data agenda yang sudah ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        // Cari agenda berdasarkan ID
        $agenda = Agenda::findOrFail($id);

        // Update data agenda
        $agenda->update([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diperbarui!');
    }
    public function destroy($id)
{
    $agenda = Agenda::findOrFail($id);
    $agenda->delete();

    return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus!');
}

}
