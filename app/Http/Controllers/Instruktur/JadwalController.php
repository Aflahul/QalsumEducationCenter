<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();
        return view('instruktur.jadwal.index', compact('jadwal'));
    }

    public function edit($id)
    {
        $jadwal = Jadwal::find($id);
        return view('instruktur.jadwal.edit', compact('jadwal'));
    }
}
