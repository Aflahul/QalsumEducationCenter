<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = Sertifikat::all();
        return view('admin.sertifikat.index', compact('sertifikat'));
    }

    public function show($id)
    {
        $sertifikat = Sertifikat::find($id);
        return view('admin.sertifikat.show', compact('sertifikat'));
    }
}
