<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Syarat;

class SyaratSeeder extends Seeder
{
    public function run(): void
    {
        Syarat::create(['konten' => 'Fotokopi KTP: 2 lembar']);
        Syarat::create(['konten' => 'Pas Foto: Ukuran 3x4, 2 lembar']);
    }
}
