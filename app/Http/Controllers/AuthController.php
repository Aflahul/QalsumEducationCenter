<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Anda tidak memiliki akses.');
            }
            return redirect()->route('admin.dashboard')->with('message', 'Selamat datang kembali');
        }

        return back()->with('error', 'Username atau password salah.');
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showResetForm()
{
    return view('auth.reset');
}

public function resetPassword(Request $request)
{
    $request->validate(['username' => 'required']);
    
    $pengguna = Pengguna::where('username', $request->username)->first();
    
    if (!$pengguna) {
        return back()->with('error', 'Username tidak ditemukan.');
    }

    // Logika untuk reset password, misalnya mengirim email atau memberikan notifikasi
    // atau bahkan mereset ke password default yang bisa diubah nanti.
    $newPassword = 'newpassword'; // Bisa dibuat lebih random atau melalui email
    $pengguna->password = bcrypt($newPassword);
    $pengguna->save();

    return redirect()->route('login')->with('message', 'Password berhasil direset l default "Administrator". Silahkan login.');
}

}
