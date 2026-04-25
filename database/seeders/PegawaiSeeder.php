<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        Pegawai::create([
            'nama' => 'Alamsyah',
            'password' => Hash::make('admin123'),
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Masamba',
            'kontak_hp' => '081234567890',
            'pendidikan_terakhir' => 'S1 Informatika',
            'jabatan' => 'admin',
            'jenis_kelamin' => 'L',
            'bidang_keahlian' => 'IT Support',
            'status' => 'aktif',
            'foto' => null
        ]);
    }
}
