<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PendaftaranKelas;

class PendaftaranKelasSeeder extends Seeder
{
    public function run()
    {
        PendaftaranKelas::create([
            'siswa_id' => 1, // Pastikan ID ini ada di tabel Siswa
            'jadwal_id' => 1, // Pastikan ID ini ada di tabel Jadwal
            'status' => 'Diterima',
        ]);
    }
}
