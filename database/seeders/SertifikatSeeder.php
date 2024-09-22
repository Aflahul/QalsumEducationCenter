<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sertifikat;

class SertifikatSeeder extends Seeder
{
    public function run()
    {
        Sertifikat::create([
            'pendaftaran_kelas_id' => 1, // Pastikan ID ini ada di tabel Siswa            
            'kode_sertifikat' => 'SNILKPLC20240087',
        ]);

        
    }
}
