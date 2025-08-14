<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        Galeri::create(['judul' => 'Kegiatan Belajar', 'foto' => null]);
        Galeri::create(['judul' => 'Wisuda Siswa', 'foto' => null]);
    }
}
