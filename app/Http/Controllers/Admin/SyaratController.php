<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Syarat;
use Illuminate\Http\Request;

class SyaratController extends Controller
{
    public function index()
    {
        $syarat = Syarat::first();
        return view('admin.profil.lembaga.syarat.index', compact('syarat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'konten' => 'required|string',
        ]);

        Syarat::updateOrCreate([], [
            'konten' => $request->konten,
        ]);

        return redirect()->route('admin.profil.lembaga.syarat.index')->with('success', 'Syarat & Ketentuan berhasil diperbarui!');
    }
}
