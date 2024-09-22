<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        Siswa::create([
            'nama' => 'Budi',
            'tanggal_lahir' => '2000-01-01',
            'alamat' => 'Jl. Raya No.1',
            'kontak_hp' => '081234567890',
            'pendidikan_terakhir' => 'SMA',
            'jenis_kelamin' => 'Laki-laki',
            'foto' => 'path/to/foto.jpg',
        ]);
        
        
        // Tambahkan data siswa lainnya jika diperlukan
    }
}

