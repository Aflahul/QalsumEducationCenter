<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    public function run()
    {
        Galeri::create([
            'judul' => 'Kegiatan Kursus April',
            'gambar' => 'galeri1.jpg',
        ]);

        Galeri::create([
            'judul' => 'Workshop Laravel',
            'gambar' => 'galeri2.jpg',
        ]);

        // Tambahkan galeri lainnya sesuai kebutuhan
    }
}
