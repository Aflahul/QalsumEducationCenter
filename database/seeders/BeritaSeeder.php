<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        Berita::create([
            'judul' => 'Pembukaan Kelas Baru',
            'konten' => 'Kami membuka kelas baru di bulan September.'
        ]);

        Berita::create([
            'judul' => 'Kunjungan Dinas Pendidikan',
            'konten' => 'Dinas Pendidikan mengunjungi LKP Contoh.'
        ]);
    }
}
