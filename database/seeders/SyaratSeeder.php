<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Syarat;

class SyaratSeeder extends Seeder
{
    public function run(): void
    {
        Syarat::create(['judul' => 'Fotokopi KTP', 'deskripsi' => '2 lembar']);
        Syarat::create(['judul' => 'Pas Foto', 'deskripsi' => 'Ukuran 3x4, 2 lembar']);
    }
}
