<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class InstrukturSeeder extends Seeder
{
    public function run(): void
    {
        Pegawai::create([
            'nama' => 'Budi Santoso',
            'password' => bcrypt('instruktur123'),
            'tanggal_lahir' => '1985-02-20',
            'alamat' => 'Jl. Instruktur',
            'kontak_hp' => '081234567001',
            'pendidikan_terakhir' => 'S1 Pendidikan',
            'jabatan' => 'instruktur',
            'jenis_kelamin' => 'L',
            'foto' => null
        ]);
    }
}
