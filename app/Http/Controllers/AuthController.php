<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Instruktur;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari instruktur dengan jabatan admin
        $instruktur = Instruktur::where('nama', $request->nama)
                                ->where('jabatan', 'admin')
                                ->first();

        if (!$instruktur) {
            return back()->withErrors(['nama' => 'Admin tidak ditemukan.']);
        }

        // Cek password
        if (!Hash::check($request->password, $instruktur->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        // Simpan session
        Session::put('instruktur_id', $instruktur->id);
        Session::put('instruktur_nama', $instruktur->nama);
        Session::put('instruktur_jabatan', $instruktur->jabatan);

        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, '.$instruktur->nama);
    }

    /**
     * Logout admin
     */
    public function logout()
    {
        Session::flush(); // Hapus semua session
        return redirect()->route('login');
    }

    /**
     * Tampilkan form reset password
     */
    public function showResetForm()
    {
        return view('auth.password_reset');
    }

    /**
     * Proses reset password admin
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string|confirmed', // harus ada password_confirmation
        ]);

        // Cari admin berdasarkan nama
        $instruktur = Instruktur::where('nama', $request->nama)
                                ->where('jabatan', 'admin')
                                ->first();

        if (!$instruktur) {
            return back()->withErrors(['nama' => 'Admin tidak ditemukan.']);
        }

        // Update password
        $instruktur->password = Hash::make($request->password);
        $instruktur->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silahkan login.');
    }
}
