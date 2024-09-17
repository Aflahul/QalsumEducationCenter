<?php

// database/seeders/PegawaiSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        DB::table('pegawai')->insert([
            [
                'username' => 'admin',
                'nama' => 'Admin Utama',
                'tanggal_lahir' => '1980-01-01',
                'alamat' => 'Jl. Admin No.1',
                'kontak_hp' => '08123456789',
                'pendidikan_terakhir' => 'S2',
                'foto' => 'admin.jpg',
                'jenis_kelamin' => 'L',
                'jabatan' => 'admin',
            ],
            [
                'username' => 'instruktur1',
                'nama' => 'Instruktur Pertama',
                'tanggal_lahir' => '1985-05-15',
                'alamat' => 'Jl. Instruktur No.2',
                'kontak_hp' => '08198765432',
                'pendidikan_terakhir' => 'S1',
                'foto' => 'instruktur1.jpg',
                'jenis_kelamin' => 'P',
                'jabatan' => 'instruktur',
            ],
            // Tambahkan pegawai lain sesuai kebutuhan
        ]);
    }
}
