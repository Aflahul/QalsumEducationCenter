<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        Agenda::create([
            'judul' => 'Pelatihan Komputer Dasar',
            'tanggal' => '2025-09-01',
            'deskripsi' => 'Pelatihan komputer dasar untuk pemula.'
        ]);

        Agenda::create([
            'judul' => 'Workshop Desain Grafis',
            'tanggal' => '2025-09-15',
            'deskripsi' => 'Pengenalan software desain grafis.'
        ]);
    }
}
