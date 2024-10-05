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
            'username' => 'ahmad_rasyid',
            'password' => Hash::make('ahmad_rasyid'),
            'nama' => 'Ahmad Rasyid',
            'role' => 'admin'
        ]);
    }
}
