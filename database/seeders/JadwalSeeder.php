<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        Jadwal::create([
            'nama_jadwal' => 'Jadwal Matematika Senin',
            'nama_kelas' => 'Kelas Matematika Dasar',
            'jalur' => 'reguler',
            'instruktur' => 'Instruktur Pertama',
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:00'
        ]);

        Jadwal::create([
            'nama_jadwal' => 'Jadwal Bahasa Inggris Rabu',
            'nama_kelas' => 'Kelas Bahasa Inggris',
            'jalur' => 'private',
            'instruktur' => 'Instruktur Pertama',
            'hari' => 'Rabu',
            'jam_mulai' => '10:00',
            'jam_selesai' => '12:00'
        ]);
    }
}
