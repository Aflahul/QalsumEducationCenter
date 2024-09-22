<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;

class NilaiSeeder extends Seeder
{
    public function run()
    {
        Nilai::create([
            'siswa_id' => 1, // Pastikan ID ini ada di tabel Siswa
            'materi_id' => 1, // Pastikan ID ini ada di tabel Materi
            'nilai' => 85,
        ]);

        Nilai::create([
            'siswa_id' => 1, // Pastikan ID ini ada di tabel Siswa
            'materi_id' => 2, // Pastikan ID ini ada di tabel Materi
            'nilai' => 90,
        ]);
    }
}
