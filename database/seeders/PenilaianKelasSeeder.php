<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenilaianKelas;

class PenilaianKelasSeeder extends Seeder
{
    public function run()
    {
        PenilaianKelas::create([
            'pendaftaran_kelas_id' => 1, // Pastikan ID ini ada di tabel Siswa
            'nilai_akhir' => '90.00', // Pastikan ID ini ada di tabel Kelas
            'grade' => 'A',
        ]);

        
    }
}

