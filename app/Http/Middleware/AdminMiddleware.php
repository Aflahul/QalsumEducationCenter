<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Memeriksa apakah pengguna sudah login dan memiliki jabatan "admin"
        if (Auth::check() && Auth::user()->pegawai->jabatan === 'admin') {
            return $next($request);
        }
        
        // Jika tidak memiliki akses, redirect ke halaman lain (misalnya halaman login atau 403 Forbidden)
        return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
