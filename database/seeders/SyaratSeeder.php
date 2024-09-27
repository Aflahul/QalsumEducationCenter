<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Syarat;

class SyaratSeeder extends Seeder
{
    public function run()
    {
        Syarat::create([
            'konten' => 'Berikut adalah syarat dan ketentuan yang berlaku di lembaga kami...',
        ]);
    }
}
