<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    use HasFactory;

    protected $table = 'pengguna';

    // Tentukan kolom mana yang dapat diisi
    protected $fillable = [
        'username',
        'password',
        'nama',
        'role'
    ];

    // Relasi ke tabel `Pegawai`
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'username', 'username');
    }
}
