<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $fillable = [
        'materi_id',
        'siswa_id',
        'nilai',
    ];

    // Relasi ke tabel Materi
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    // Relasi ke tabel Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
