<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $fillable = [
        'id_kelas',
        'id_instruktur',
        'nama_jadwal',
        'tanggal_mulai',
        'tanggal_selesai',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_jadwal');
    }

    public function instruktur()
    {
        return $this->belongsTo(Pegawai::class, 'id_instruktur');
    }
}
