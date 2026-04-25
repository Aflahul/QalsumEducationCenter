<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;

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
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari pegawai dengan jabatan admin
        $pegawai = Pegawai::where('nama', $request->username)
                                ->where('jabatan', 'admin')
                                ->first();

        if (!$pegawai) {
            return back()->withErrors(['username' => 'Admin tidak ditemukan.']);
        }

        // Cek password
        if (!Hash::check($request->password, $pegawai->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        // Login menggunakan sistem Auth Laravel
        Auth::login($pegawai);

        // Simpan session (untuk kompatibilitas dengan kode lama)
        Session::put('instruktur_id', $pegawai->id);
        Session::put('instruktur_nama', $pegawai->nama);
        Session::put('instruktur_jabatan', $pegawai->jabatan);

        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, '.$pegawai->nama);
    }

    /**
     * Logout admin
     */
    public function logout()
    {
        Auth::logout();
        Session::flush(); // Hapus semua session
        return redirect()->route('login');
    }

    /**
     * Tampilkan form reset password
     */
    public function showResetForm()
    {
        return view('auth.reset');
    }

    /**
     * Proses reset password admin
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|confirmed', // harus ada password_confirmation
        ]);

        // Cari admin berdasarkan nama
        $pegawai = Pegawai::where('nama', $request->username)
                                ->where('jabatan', 'admin')
                                ->first();

        if (!$pegawai) {
            return back()->withErrors(['username' => 'Admin tidak ditemukan.']);
        }

        // Update password
        $pegawai->password = Hash::make($request->password);
        $pegawai->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silahkan login.');
    }
}
