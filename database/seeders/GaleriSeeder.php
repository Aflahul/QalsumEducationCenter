<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        Galeri::create(['judul' => 'Kegiatan Belajar', 'gambar' => null]);
        Galeri::create(['judul' => 'Wisuda Siswa', 'gambar' => null]);
    }
}
