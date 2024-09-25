<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi';

    protected $fillable = [
        'nama_materi',
        'deskripsi',
        'id_kelas', // Menghubungkan dengan kelas
    ];

    // Relasi dengan kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    // Relasi dengan penilaian_kelas
     public function penilaianKelas()
{
    return $this->hasMany(PenilaianKelas::class, 'id_materi');
}

}
