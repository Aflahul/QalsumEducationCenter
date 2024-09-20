<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        Pegawai::create([
            'pegawai_id' => 'PG00001',
            'nama' => 'Instruktur Pertama',
            'username' => 'instruktur1',
            'tanggal_lahir' => '1985-05-15',
            'alamat' => 'Jl. Contoh Alamat No. 1',
            'kontak_hp' => '081234567890',
            'pendidikan_terakhir' => 'S1 Pendidikan',
            'jabatan' => 'instruktur',
            'foto' => null
        ]);

        Pegawai::create([
            'pegawai_id' => 'PG00002',
            'nama' => 'Admin Pertama',
            'username' => 'admin1',
            'tanggal_lahir' => '1990-08-21',
            'alamat' => 'Jl. Contoh Alamat No. 2',
            'kontak_hp' => '081234567891',
            'pendidikan_terakhir' => 'S1 Manajemen',
            'jabatan' => 'instruktur',
            'foto' => null
        ]);
    }
}
