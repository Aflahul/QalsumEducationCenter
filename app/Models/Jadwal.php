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
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    // Relasi ke tabel `Pegawai` (instruktur)
    public function instruktur()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
    
     public function penilaianKelas()
    {
        return $this->hasMany(PenilaianKelas::class, 'id_jadwal');
    }
    public function siswa()
{
    return $this->hasMany(Siswa::class, 'id_jadwal');
}

}
