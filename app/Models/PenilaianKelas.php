<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKelas extends Model
{
    use HasFactory;

    protected $table = 'penilaian_kelas';

    protected $fillable = [
        'pendaftaran_kelas_id',
        'nilai_akhir',
        'grade',
    ];

    // Relasi ke tabel PendaftaranKelas
    public function pendaftaranKelas()
    {
        return $this->belongsTo(PendaftaranKelas::class);
    }
}
