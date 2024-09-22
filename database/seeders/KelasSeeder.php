<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        Kelas::create([
            'nama_kelas' => 'Kelas Matematika Dasar',
            'deskripsi' => 'Kelas untuk pemula dalam matematika dasar.',
            'jenis_kelas' => 'private',
            'biaya' => 1000000
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas Bahasa Inggris',
            'deskripsi' => 'Kelas untuk mempelajari bahasa Inggris dasar.',
            'jenis_kelas' => 'reguler',
            'biaya' => 1200000
        ]);
    }
}
