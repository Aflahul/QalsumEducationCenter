<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        Jadwal::insert([
            [
                'id_kelas' => 1, // Pastikan ID ini ada di tabel kelas
                'id_pegawai' => 1, // Pastikan ID ini ada di tabel pegawai
                'nama_jadwal' => 'Jadwal Kelas Pemula',
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelas' => 1,
                'id_pegawai' => 2,
                'nama_jadwal' => 'Jadwal Kelas Pemula Sore',
                'hari' => 'Rabu',
                'jam_mulai' => '15:00:00',
                'jam_selesai' => '17:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelas' => 2,
                'id_pegawai' => 3,
                'nama_jadwal' => 'Jadwal Kelas Menengah',
                'hari' => 'Selasa',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kelas' => 3,
                'id_pegawai' => 4,
                'nama_jadwal' => 'Jadwal Kelas Private',
                'hari' => 'Kamis',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '15:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
