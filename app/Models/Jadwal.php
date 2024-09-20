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
        'nama_kelas',
        'jalur',
        'instruktur',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    // Relasi ke tabel `Kelas`
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'nama_kelas', 'nama_kelas');
    }

    // Relasi ke tabel `Pegawai` (instruktur)
    public function instruktur()
    {
        return $this->belongsTo(Pegawai::class, 'instruktur', 'nama');
    }
}
