<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    use HasFactory;

    protected $table = 'instruktur';

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'alamat',
        'kontak_hp',
        'pendidikan_terakhir',
        'bidang_keahlian',
        'jenis_kelamin',
        'foto'
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_instruktur');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_instruktur');
    }
}
