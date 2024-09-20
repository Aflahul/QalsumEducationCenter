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
        'biaya_reguler',
        'biaya_private'
    ];

    // Relasi ke tabel `Jadwal`
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'nama_kelas', 'nama_kelas');
    }
}
