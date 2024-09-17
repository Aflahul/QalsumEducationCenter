<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'username',
        'nama',
        'tanggal_lahir',
        'alamat',
        'kontak_hp',
        'pendidikan_terakhir',
        'foto',
        'jenis_kelamin',
        'jabatan',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'username', 'username');
    }
}
