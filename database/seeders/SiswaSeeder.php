<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() 
    {
        Siswa::insert([
            [
                'nomor_siswa' => 'SW0001',
                'nama' => 'Rina Safitri',
                'id_jadwal' => 1, // Pastikan ID ini ada di tabel jadwal
                'tanggal_lahir' => '2005-04-12',
                'alamat' => 'Jl. Mawar No. 20, Jakarta',
                'kontak_hp' => '085123456789',
                'pendidikan_terakhir' => 'SMP',
                'jenis_kelamin' => 'Perempuan',
                'foto' => 'uploads/siswa/foto-rina.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_siswa' => 'S002',
                'nama' => 'Andi Setiawan',
                'id_jadwal' => 2,
                'tanggal_lahir' => '2004-10-05',
                'alamat' => 'Jl. Anggrek No. 15, Bandung',
                'kontak_hp' => '085987654321',
                'pendidikan_terakhir' => 'SMP',
                'jenis_kelamin' => 'Laki-laki',
                'foto' => 'uploads/siswa/foto-andi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_siswa' => 'SW0003',
                'nama' => 'Siti Nurhaliza',
                'id_jadwal' => 3,
                'tanggal_lahir' => '2006-01-20',
                'alamat' => 'Jl. Melati No. 30, Yogyakarta',
                'kontak_hp' => '082345678901',
                'pendidikan_terakhir' => 'SD',
                'jenis_kelamin' => 'Perempuan',
                'foto' => 'uploads/siswa/foto-siti.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_siswa' => 'SW0004',
                'nama' => 'Budi Prasetyo',
                'id_jadwal' => 1,
                'tanggal_lahir' => '2005-08-17',
                'alamat' => 'Jl. Kenanga No. 8, Surabaya',
                'kontak_hp' => '083456789012',
                'pendidikan_terakhir' => 'SMP',
                'jenis_kelamin' => 'Laki-laki',
                'foto' => 'uploads/siswa/foto-budi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }    
}
