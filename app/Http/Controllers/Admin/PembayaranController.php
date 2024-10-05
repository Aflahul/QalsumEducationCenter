<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // Menampilkan daftar pembayaran
    public function index()
    {
        // Retrieve all payments and associated siswa data
        $pembayaran = Pembayaran::with('siswa.jadwal.kelas')->get();
         $siswa = Siswa::doesntHave('pembayaran')->get(); // Mengambil siswa yang tidak memiliki pembayaran
        $countSiswaBelumBayar = $siswa->count(); // Menghitung jumlah siswa yang belum membayar
   
        

        return view('admin.pembayaran.index', compact('pembayaran', 'siswa','countSiswaBelumBayar'));
    }

    public function inputSiswa(Request $request)
    {
        // Validate the request
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id',
        ]);

        // Get the selected siswa and calculate total biaya
        $siswa = Siswa::with('jadwal.kelas')->find($request->id_siswa);
        $totalBiaya = $siswa->jadwal->kelas->biaya;

        // Create a new pembayaran entry
        $pembayaran = Pembayaran::create([
            'id_siswa' => $siswa->id,
            'biaya_total' => $totalBiaya,
            'angsuran1' => 0, // Initial value
            'angsuran2' => 0,   // Initial value
            'sisa_pembayaran' => $totalBiaya, // Set initial sisa payment
            'status' => 'Belum Lunas', // Default status
        ]);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'angsuran1' => 'required|numeric',
            'angsuran2' => 'required|numeric',
        ]);

        // Find the pembayaran record
        $pembayaran = Pembayaran::findOrFail($id);

        // Update the angsuran values
        $pembayaran->angsuran1 = $request->angsuran1;
        $pembayaran->angsuran2 = $request->angsuran2;

        // Calculate remaining balance and update status
        $pembayaran->sisa_pembayaran = $pembayaran->biaya_total - $pembayaran->angsuran1 - $pembayaran->angsuran2;
        $pembayaran->status = $pembayaran->sisa_pembayaran == 0 ? 'Lunas' : 'Belum Lunas';

        // Save changes
        $pembayaran->save();

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }
}