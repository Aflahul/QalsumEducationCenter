<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::create([
            'nama_kelas' => 'Kelas Komputer Dasar',
            'deskripsi' => 'Belajar dasar komputer'
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas Desain Grafis',
            'deskripsi' => 'Belajar Adobe Photoshop & CorelDraw'
        ]);
    }
}
