<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        Pembayaran::create([
            'pendaftaran_kelas_id' => 1, // Pastikan ID ini ada di tabel Siswa
            'jumlah_bayar' => 1000000,
            'status' => 'Lunas',
            'bukti_pembayaran' => 'path/to/foto.jpg',
        ]);
    }
}
