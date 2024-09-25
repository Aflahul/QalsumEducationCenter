<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        Kelas::insert([
            [
                'nama_kelas' => 'Kelas Pemula',
                'deskripsi' => 'Kelas untuk pemula yang ingin belajar dasar-dasar.',
                'jenis_kelas' => 'reguler',
                'biaya' => 1500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'Kelas Menengah',
                'deskripsi' => 'Kelas untuk siswa yang sudah memiliki pengetahuan dasar.',
                'jenis_kelas' => 'reguler',
                'biaya' => 2000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'Kelas Private',
                'deskripsi' => 'Kelas private satu-satu untuk pembelajaran intensif.',
                'jenis_kelas' => 'private',
                'biaya' => 3000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kelas' => 'Kelas Lanjutan',
                'deskripsi' => 'Kelas untuk siswa yang ingin mengembangkan keterampilan lebih lanjut.',
                'jenis_kelas' => 'reguler',
                'biaya' => 2500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
