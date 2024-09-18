<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('pendaftaran.index');
    }

    public function store(Request $request)
    {
        Pendaftaran::create($request->all());
        return redirect()->route('pendaftaran.confirm')->with('success', 'Pendaftaran berhasil.');
    }

    public function confirm()
    {
        return view('pendaftaran.confirm');
    }
}
