<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran';

    protected $fillable = [
        'id_siswa',   // ID siswa yang mendaftar
        'id_kelas',   // ID kelas yang didaftar
        'tanggal_daftar', // Tanggal pendaftaran
        'status'      // Status pendaftaran (aktif, selesai, batal, dll)
    ];

    /**
     * Relasi ke model Siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    /**
     * Relasi ke model Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    /**
     * Relasi ke model Pembayaran
     */
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_pendaftaran');
    }

    /**
     * Relasi ke model Nilai
     */
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_pendaftaran');
    }
}
