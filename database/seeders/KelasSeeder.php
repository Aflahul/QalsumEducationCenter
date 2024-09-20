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
            'biaya_reguler' => 500000,
            'biaya_private' => 1000000
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas Bahasa Inggris',
            'deskripsi' => 'Kelas untuk mempelajari bahasa Inggris dasar.',
            'biaya_reguler' => 600000,
            'biaya_private' => 1200000
        ]);
    }
}
