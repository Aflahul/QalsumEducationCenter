<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikat';

    protected $fillable = [
        'pendaftaran_kelas_id',
        'kode_sertifikat',
    ];

    // Relasi ke tabel PendaftaranKelas
    public function pendaftaranKelas()
    {
        return $this->belongsTo(PendaftaranKelas::class);
    }
}
