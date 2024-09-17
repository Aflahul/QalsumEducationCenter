<?php

// database/seeders/PenggunaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengguna')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'nama' => 'Admin Utama',
            ],
            [
                'username' => 'instruktur1',
                'password' => Hash::make('instruktur1'),
                'role' => 'instruktur',
                'nama' => 'Instruktur Pertama',
            ],
            // Tambahkan pengguna lain sesuai kebutuhan
        ]);
    }
}

