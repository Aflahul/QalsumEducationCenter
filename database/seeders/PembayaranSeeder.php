<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Pembayaran::insert([
            [
                'id_siswa' => 1, // Pastikan ID ini ada di tabel siswa
                'angsuran1' => 500000,
                'angsuran2' => 500000,
                'sisa_pembayaran' => 0,
                'biaya_total' => 1000000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_siswa' => 2,
                'angsuran1' => 300000,
                'angsuran2' => null,
                'sisa_pembayaran' => 700000,
                'biaya_total' => 1000000,
                'status' => 'Belum Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_siswa' => 3,
                'angsuran1' => 250000,
                'angsuran2' => 250000,
                'sisa_pembayaran' => 500000,
                'biaya_total' => 1000000,
                'status' => 'Belum Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_siswa' => 4,
                'angsuran1' => 1000000,
                'angsuran2' => null,
                'sisa_pembayaran' => 0,
                'biaya_total' => 1000000,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    
}
