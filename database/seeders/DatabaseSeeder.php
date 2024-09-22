<?php

namespace Database\Seeders;

use SiswaSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\KelasSeeder;
use Database\Seeders\NilaiSeeder;
use Database\Seeders\JadwalSeeder;
use Database\Seeders\MateriSeeder;
use Database\Seeders\PegawaiSeeder;
use Database\Seeders\PenggunaSeeder;
use Database\Seeders\PembayaranSeeder;
use Database\Seeders\SertifikatSeeder;
use Database\Seeders\PenilaianKelasSeeder;
use Database\Seeders\PendaftaranKelasSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // SiswaSeeder::class,
            // PendaftaranKelasSeeder::class,
            // PembayaranSeeder::class,
            // MateriSeeder::class,
            // NilaiSeeder::class,
            PenilaianKelasSeeder::class,
            SertifikatSeeder::class,
        ]);
    }
}
