<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder
{
    public function run()
    {
        Berita::create([
            'judul' => 'Kursus Pemrograman Gratis',
            'konten' => 'Kami menawarkan kursus pemrograman gratis untuk masyarakat.',
            'tanggal_publikasi' => '2024-04-20',
            'gambar' => 'berita1.jpg',
        ]);

        Berita::create([
            'judul' => 'Webinar Keamanan Siber',
            'konten' => 'Ikuti webinar tentang keamanan siber yang akan datang.',
            'tanggal_publikasi' => '2024-05-10',
            'gambar' => 'berita2.jpg',
        ]);

        // Tambahkan berita lainnya sesuai kebutuhan
    }
}
