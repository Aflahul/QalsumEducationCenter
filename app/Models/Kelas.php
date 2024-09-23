<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    // Tentukan kolom mana yang dapat diisi
    protected $fillable = [
        'nama_kelas',
        'deskripsi',
        'jenis_kelas',
        'biaya'
    ];

    // Relasi ke tabel `Jadwal`
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas');
    }
    
}
