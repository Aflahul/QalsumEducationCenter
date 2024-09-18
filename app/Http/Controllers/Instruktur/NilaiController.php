<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::all();
        return view('instruktur.nilai.index', compact('nilai'));
    }

    public function edit($id)
    {
        $nilai = Nilai::find($id);
        return view('instruktur.nilai.edit', compact('nilai'));
    }

    public function update(Request $request, $id)
    {
        $nilai = Nilai::find($id);
        $nilai->update($request->all());
        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diperbarui.');
    }
}
