<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    // Tentukan kolom mana yang dapat diisi
    protected $fillable = [
        'nama_jadwal',
        'id_kelas',
        'id_pegawai',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    // Relasi ke tabel `Kelas`
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    // Relasi ke tabel `Pegawai` (instruktur)
    public function instruktur()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
