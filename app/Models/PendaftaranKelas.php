<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranKelas extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_kelas';

    protected $fillable = [
        'siswa_id',
        'jadwal_id',        
        'status',
    ];

    // Relasi ke tabel Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relasi ke tabel Jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    // Relasi ke tabel Pembayaran
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    // Relasi ke tabel PenilaianKelas
    public function penilaianKelas()
    {
        return $this->hasOne(PenilaianKelas::class);
    }
}
