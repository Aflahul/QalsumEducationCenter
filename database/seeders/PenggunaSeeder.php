<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        Pengguna::create([
            'username' => 'instruktur1',
            'password' => Hash::make('password123'),
            'nama' => 'Instruktur Pertama',
            'role' => 'instruktur'
        ]);

        Pengguna::create([
            'username' => 'admin1',
            'password' => Hash::make('password123'),
            'nama' => 'Admin Pertama',
            'role' => 'admin'
        ]);
    }
}
