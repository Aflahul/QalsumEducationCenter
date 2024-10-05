<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticatePengguna
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login di session
        if (!session()->has('login_pengguna')) {
            return redirect()->route('login.form')->with('error', 'Anda harus login terlebih dahulu.');
        }

        return $next($request);
    }
}
