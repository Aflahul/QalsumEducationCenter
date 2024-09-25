<?php

namespace Database\Seeders;

use App\Models\Materi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
         Materi::insert([
            [
                'nama_materi' => 'Pengenalan Dasar Pemrograman',
                'deskripsi' => 'Materi ini mencakup pengenalan bahasa pemrograman dan dasar-dasar logika pemrograman.',
                'id_kelas' => 1, // Pastikan ID ini ada di tabel kelas
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_materi' => 'Struktur Data',
                'deskripsi' => 'Pembelajaran tentang struktur data yang digunakan dalam pemrograman.',
                'id_kelas' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_materi' => 'Algoritma Pemrograman',
                'deskripsi' => 'Materi ini membahas tentang algoritma dan cara menyusun algoritma yang efektif.',
                'id_kelas' => 2, // Pastikan ID ini ada di tabel kelas
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_materi' => 'Database dan SQL',
                'deskripsi' => 'Materi ini mencakup dasar-dasar penggunaan database dan query menggunakan SQL.',
                'id_kelas' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_materi' => 'Web Development Dasar',
                'deskripsi' => 'Pengantar pembuatan website menggunakan HTML, CSS, dan JavaScript.',
                'id_kelas' => 3, // Pastikan ID ini ada di tabel kelas
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}