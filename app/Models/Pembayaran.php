<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'id_siswa', 
        'biaya_total',
        'angsuran1',
        'angsuran2',
        'sisa_pembayaran',
        'bukti',
        'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    // Relasi ke Jadwal melalui Siswa
    public function jadwal()
    {
        return $this->hasOneThrough(Jadwal::class, Siswa::class, 'id', 'id', 'id_siswa', 'id_jadwal');
    }

    // Relasi ke Kelas melalui Jadwal
    public function kelas()
    {
        return $this->hasOneThrough(Kelas::class, Jadwal::class, 'id', 'id', 'id_siswa', 'id_kelas');
    }
}
