<?php

namespace Database\Seeders;

use App\Models\Profil;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfilSeeder extends Seeder
{
    public function run()
    {
        Profil::create([
            'nama_lembaga' => 'Qalsum Education Center',
            'alamat' => 'Jl. Pendidikan No. 123, Jakarta',
            'telepon' => '08123456789',
            'email' => 'info@qalsum-edu.com',
            'website' => 'https://www.qalsum-edu.com',
            'logo' => 'uploads\logo\qec.png',
            'deskripsi' => 'Qalsum Education Center adalah lembaga pendidikan yang menyediakan berbagai kursus untuk meningkatkan kemampuan akademik dan non-akademik siswa. Dengan pengajar yang berpengalaman, kami siap membantu Anda mencapai kesuksesan dalam pendidikan.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
