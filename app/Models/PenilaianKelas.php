<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianKelas extends Model
{
    protected $table = 'penilaian_kelas';

    protected $fillable = [
        'id_siswa',
        'id_jadwal',
        'id_materi',
        'nilai',
        'catatan',
    ];

    // Relasi dengan siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    // Relasi dengan jadwal
    public function kelas()
    {
        return $this->belongsTo(Jadwal::class, 'id_kelas');
    }

    // Relasi dengan materi
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi');
    }
}
