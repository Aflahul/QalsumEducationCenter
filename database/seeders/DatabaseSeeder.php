<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\KelasSeeder;
use Database\Seeders\NilaiSeeder;
use Database\Seeders\SiswaSeeder;
use Database\Seeders\JadwalSeeder;
use Database\Seeders\MateriSeeder;
use Database\Seeders\PegawaiSeeder;
use Database\Seeders\PembayaranSeeder;
use Database\Seeders\SertifikatSeeder;
use Database\Seeders\PenilaianKelasSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // KelasSeeder::class,
            // PegawaiSeeder::class,
            // JadwalSeeder::class,
            // SiswaSeeder::class,
            // MateriSeeder::class,
            // PembayaranSeeder::class,
            // PenilaianKelasSeeder::class,
            // NilaiSeeder::class,
            // SertifikatSeeder::class,
            // AgendaSeeder::class,
            // BeritaSeeder::class,
            // GaleriSeeder::class,
            // SyaratSeeder::class,
            ProfilSeeder::class,
            
        ]);
    }
}
