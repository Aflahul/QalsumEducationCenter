<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::create([
            'nama_kelas' => 'Kelas Komputer Dasar',
            'id_instruktur' => 2,
            'deskripsi' => 'Belajar dasar komputer',
            'biaya_reguler' => 500000,
            'biaya_private' => 750000
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas Desain Grafis',
            'id_instruktur' => 3,
            'deskripsi' => 'Belajar Adobe Photoshop & CorelDraw',
            'biaya_reguler' => 600000,
            'biaya_private' => 900000
        ]);

        Kelas::create([
            'nama_kelas' => 'Kelas Microsoft Office',
            'id_instruktur' => 4,
            'deskripsi' => 'Belajar Word, Excel, PowerPoint',
            'biaya_reguler' => 450000,
            'biaya_private' => 700000
        ]);
    }
}
