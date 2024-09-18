<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('instruktur.dashboard');
    }
}
