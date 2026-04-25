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
            'bidang_keahlian' => 'Komputer Dasar',
            'status' => 'aktif',
            'foto' => null
        ]);

        Pegawai::create([
            'nama' => 'Siti Aminah',
            'password' => bcrypt('instruktur123'),
            'tanggal_lahir' => '1990-05-15',
            'alamat' => 'Jl. Mawar',
            'kontak_hp' => '081234567002',
            'pendidikan_terakhir' => 'S1 Desain',
            'jabatan' => 'instruktur',
            'jenis_kelamin' => 'P',
            'bidang_keahlian' => 'Desain Grafis',
            'status' => 'aktif',
            'foto' => null
        ]);

        Pegawai::create([
            'nama' => 'Andi Wijaya',
            'password' => bcrypt('instruktur123'),
            'tanggal_lahir' => '1988-11-10',
            'alamat' => 'Jl. Melati',
            'kontak_hp' => '081234567003',
            'pendidikan_terakhir' => 'S1 Informatika',
            'jabatan' => 'instruktur',
            'jenis_kelamin' => 'L',
            'bidang_keahlian' => 'Web Development',
            'status' => 'aktif',
            'foto' => null
        ]);

        Pegawai::create([
            'nama' => 'Rina Pratama',
            'password' => bcrypt('instruktur123'),
            'tanggal_lahir' => '1992-03-25',
            'alamat' => 'Jl. Anggrek',
            'kontak_hp' => '081234567004',
            'pendidikan_terakhir' => 'S1 Akuntansi',
            'jabatan' => 'instruktur',
            'jenis_kelamin' => 'P',
            'bidang_keahlian' => 'Microsoft Office',
            'status' => 'aktif',
            'foto' => null
        ]);
    }
}
