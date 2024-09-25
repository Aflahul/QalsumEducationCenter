<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        Pegawai::insert([
            [
                'pegawai_id' => 'PG0001',
                'nama' => 'Ahmad Rasyid',
                'username' => 'ahmad_rasyid',
                'tanggal_lahir' => '1985-06-15',
                'alamat' => 'Jl. Merpati No. 10, Jakarta',
                'jabatan' => 'instruktur',
                'kontak_hp' => '081234567890',
                'pendidikan_terakhir' => 'S1 Pendidikan',
                'foto' => 'uploads/pegawai/foto-ahmad.jpg',
                'jenis_kelamin' => 'Laki-laki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pegawai_id' => 'PG0002',
                'nama' => 'Siti Aminah',
                'username' => 'siti_aminah',
                'tanggal_lahir' => '1990-02-20',
                'alamat' => 'Jl. Anggrek No. 5, Bandung',
                'jabatan' => 'instruktur',
                'kontak_hp' => '082345678901',
                'pendidikan_terakhir' => 'S2 Pendidikan',
                'foto' => 'uploads/pegawai/foto-siti.jpg',
                'jenis_kelamin' => 'Perempuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pegawai_id' => 'PG0003',
                'nama' => 'Budi Santoso',
                'username' => 'budi_santoso',
                'tanggal_lahir' => '1988-12-01',
                'alamat' => 'Jl. Kenanga No. 8, Surabaya',
                'jabatan' => 'instruktur',
                'kontak_hp' => '083456789012',
                'pendidikan_terakhir' => 'S1 Matematika',
                'foto' => 'uploads/pegawai/foto-budi.jpg',
                'jenis_kelamin' => 'Laki-laki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pegawai_id' => 'PG0004',
                'nama' => 'Nina Widiastuti',
                'username' => 'nina_widiastuti',
                'tanggal_lahir' => '1992-11-11',
                'alamat' => 'Jl. Melati No. 7, Yogyakarta',
                'jabatan' => 'instruktur',
                'kontak_hp' => '084567890123',
                'pendidikan_terakhir' => 'S1 Bahasa Inggris',
                'foto' => 'uploads/pegawai/foto-nina.jpg',
                'jenis_kelamin' => 'Perempuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
