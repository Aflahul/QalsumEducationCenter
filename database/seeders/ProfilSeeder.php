<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profil;

class ProfilSeeder extends Seeder
{
    public function run(): void
    {
        Profil::create([
            'nama_lembaga' => 'LKP Contoh',
            'alamat' => 'Jl. Pendidikan No. 1, Masamba',
            'telepon' => '081234567890',
            'email' => 'info@lkpcontoh.com',
            'website' => 'https://lkpcontoh.com',
            'logo' => null,
            'deskripsi' => 'Lembaga Kursus dan Pelatihan terbaik di Masamba.'
        ]);
    }
}
