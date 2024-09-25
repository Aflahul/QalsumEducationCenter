<?php

namespace Database\Seeders;

use App\Models\Sertifikat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SertifikatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
         Sertifikat::insert([
            [
                'id_siswa' => 1, // Pastikan ID ini ada di tabel siswa
                'nomor_sertifikat' => 'CERT-001',
                'nama_kelas' => 'Pemrograman Dasar',
                'daftar_nilai' => json_encode([
                    'Materi 1' => 85,
                    'Materi 2' => 90,
                    'Materi 3' => 80,
                ]),
                'grade' => 'A',
                'tanggal_penyelesaian' => '2024-08-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_siswa' => 2,
                'nomor_sertifikat' => 'CERT-002',
                'nama_kelas' => 'Data Structures',
                'daftar_nilai' => json_encode([
                    'Materi 1' => 78,
                    'Materi 2' => 82,
                    'Materi 3' => 75,
                ]),
                'grade' => 'B',
                'tanggal_penyelesaian' => '2024-08-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_siswa' => 3,
                'nomor_sertifikat' => 'CERT-003',
                'nama_kelas' => 'Algoritma dan Pemrograman',
                'daftar_nilai' => json_encode([
                    'Materi 1' => 90,
                    'Materi 2' => 92,
                    'Materi 3' => 88,
                ]),
                'grade' => 'A',
                'tanggal_penyelesaian' => '2024-08-25',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_siswa' => 4,
                'nomor_sertifikat' => 'CERT-004',
                'nama_kelas' => 'Basis Data',
                'daftar_nilai' => json_encode([
                    'Materi 1' => 70,
                    'Materi 2' => 65,
                    'Materi 3' => 72,
                ]),
                'grade' => 'C',
                'tanggal_penyelesaian' => '2024-08-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
