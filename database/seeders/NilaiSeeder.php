<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\PenilaianKelas;
use App\Models\Nilai;

class NilaiSeeder extends Seeder
{
    public function run()
    {
        $siswaList = Siswa::all();

        foreach ($siswaList as $siswa) {
            $kelas = $siswa->jadwal->kelas; // Mendapatkan kelas dari jadwal siswa
            $penilaianKelas = PenilaianKelas::where('id_siswa', $siswa->id)
                                             ->where('id_kelas', $kelas->id)
                                             ->get();

            $nilai_total = $penilaianKelas->sum('nilai');
            $nilai_rata_rata = $penilaianKelas->avg('nilai');
            $grade = $this->hitungGrade($nilai_rata_rata);

            Nilai::create([
                'id_siswa' => $siswa->id,
                'id_kelas' => $kelas->id,
                'nilai_total' => $nilai_total,
                'nilai_rata_rata' => $nilai_rata_rata,
                'grade' => $grade
            ]);
        }
    }

    private function hitungGrade($nilai_rata_rata)
    {
        if ($nilai_rata_rata >= 85) {
            return 'A';
        } elseif ($nilai_rata_rata >= 75) {
            return 'B';
        } elseif ($nilai_rata_rata >= 60) {
            return 'C';
        } else {
            return 'D';
        }
    }
}
