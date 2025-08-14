<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // kalau pegawai juga dipakai untuk login
use Illuminate\Notifications\Notifiable;

class Pegawai extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pegawai';
    protected $fillable = [
        'nama',
        'password',
        'tanggal_lahir',
        'alamat',
        'kontak_hp',
        'pendidikan_terakhir',
        'bidang_keahlian',
        'status',
        'jabatan',
        'jenis_kelamin',
        'foto',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi ke kelas (sebagai instruktur)
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_instruktur');
    }

    // Scope untuk ambil instruktur saja
    public function scopeInstruktur($query)
    {
        return $query->where('jabatan', 'instruktur');
    }
}
