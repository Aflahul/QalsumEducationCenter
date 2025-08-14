<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\KelasSeeder;
use Database\Seeders\SiswaSeeder;
use Database\Seeders\AgendaSeeder;
use Database\Seeders\BeritaSeeder;
use Database\Seeders\GaleriSeeder;
use Database\Seeders\JadwalSeeder;
use Database\Seeders\MateriSeeder;
use Database\Seeders\ProfilSeeder;
use Database\Seeders\SyaratSeeder;
use Database\Seeders\PegawaiSeeder;
use Database\Seeders\PenilaianSeeder;
use Database\Seeders\InstrukturSeeder;
use Database\Seeders\PembayaranSeeder;
use Database\Seeders\SertifikatSeeder;
use Database\Seeders\PendaftaranSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProfilSeeder::class,
            AgendaSeeder::class,
            BeritaSeeder::class,
            GaleriSeeder::class,
            SyaratSeeder::class,
            PegawaiSeeder::class,
            InstrukturSeeder::class,
            KelasSeeder::class,
            MateriSeeder::class,
            JadwalSeeder::class,
            SiswaSeeder::class,
            PendaftaranSeeder::class,
            PembayaranSeeder::class,
            PenilaianSeeder::class,
            SertifikatSeeder::class,
            
        ]);
    }
}
