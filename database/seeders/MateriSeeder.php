<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;

class MateriSeeder extends Seeder
{
    public function run()
    {
        Materi::create([
            'nama_materi' => 'Materi 1',
            'deskripsi' => 'Materi 1',
            'kelas_id' => 1, // Pastikan ID ini ada di tabel Kelas
        ]);

        Materi::create([
            'nama_materi' => 'Materi 2',
            'deskripsi' => 'Materi 2',
            'kelas_id' => 1, // Pastikan ID ini ada di tabel Kelas
        ]);
    }
}
