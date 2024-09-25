<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\PenilaianKelas;

class PenilaianKelasSeeder extends Seeder
{
    public function run()
    {
        $siswaList = Siswa::all();
        $kelasList = Kelas::all();
        $materiList = Materi::all();

        foreach ($siswaList as $siswa) {
            $kelas = $siswa->jadwal->kelas; // Mendapatkan kelas dari jadwal siswa

            foreach ($materiList as $materi) {
                PenilaianKelas::create([
                    'id_siswa' => $siswa->id,
                    'id_kelas' => $kelas->id,
                    'id_materi' => $materi->id,
                    'nilai' => rand(60, 100), // Nilai acak untuk contoh
                    'catatan' => 'Penilaian otomatis'
                ]);
            }
        }
    }
}
