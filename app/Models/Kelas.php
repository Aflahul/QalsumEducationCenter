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
        'jalur',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'kelas_id');
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'kelas_id');
    }
}
