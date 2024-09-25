<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    // Tentukan kolom mana yang dapat diisi
    protected $fillable = [
        'pegawai_id',
        'nama',
        'username',
        'tanggal_lahir',
        'alamat',
        'kontak_hp',
        'pendidikan_terakhir',
        'jabatan',
        'jenis_kelamin',
        'foto'
    ];

    // Relasi ke tabel `Pengguna`
    public function pengguna()
    {
        return $this->hasOne(Pengguna::class, 'username', 'username');
        // return $this->belongsTo(Pengguna::class, 'username', 'username');
    }

    // Relasi ke tabel `Jadwal` (untuk instruktur)
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_pegawai', 'id');
    }
}
