<?php

namespace App\Models;

use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\PenilaianKelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    // Tentukan kolom mana yang dapat diisi
    protected $fillable = [
        'nama_kelas',
        'deskripsi',
        'jenis_kelas',
        'biaya'
    ];

    // Relasi ke tabel `Jadwal`
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas');
    }
     

    // Relasi dengan materi
    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_kelas');
    }
    public function penilaianKelas()
{
    return $this->hasMany(PenilaianKelas::class, 'id_kelas');
}
public function nilai()
{
    return $this->hasMany(Nilai::class, 'id_kelas');
}

}
