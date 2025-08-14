<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'deskripsi',
        'durasi',
        'biaya_reguler',
        'biaya_private'
    ];

    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_kelas');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_kelas');
    }
}
