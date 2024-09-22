<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'username',
        'tanggal_lahir',
        'alamat',
        'kontak_hp',
        'pendidikan_terakhir',
        'jenis_kelamin',
    ];

    // Relasi ke tabel PendaftaranKelas
    public function pendaftaranKelas()
    {
        return $this->hasMany(PendaftaranKelas::class);
    }

    // Relasi ke tabel Nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
    
}

