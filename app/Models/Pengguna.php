<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';

    protected $fillable = [
        'username',
        'password',
        'role',
        'nama',
    ];

    // Relasi dengan model Pegawai, Instruktur, dan Siswa
    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'username', 'username');
    }

    public function instruktur()
    {
        return $this->hasOne(Instruktur::class, 'username', 'username');
    }

    // public function siswa()
    // {
    //     return $this->hasOne(Siswa::class, 'username', 'username');
    // }
}
