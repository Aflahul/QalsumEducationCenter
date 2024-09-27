<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;

class AgendaSeeder extends Seeder
{
    public function run()
    {
        Agenda::create([
            'judul' => 'Pembukaan Kursus Baru',
            'tanggal' => '2024-05-01',
            'deskripsi' => 'Kami membuka pendaftaran untuk kursus baru mulai bulan Mei.',
        ]);

        Agenda::create([
            'judul' => 'Workshop Laravel',
            'tanggal' => '2024-06-15',
            'deskripsi' => 'Workshop intensif tentang pengembangan aplikasi dengan Laravel.',
        ]);

        // Tambahkan agenda lainnya sesuai kebutuhan
    }
}
