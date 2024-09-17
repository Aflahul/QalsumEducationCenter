<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        // 'username',
        'nama',
        'tanggal_lahir',
        'alamat',
        'kontak_hp',
        'foto',
        'jenis_kelamin',
    ];

    // public function pengguna()
    // {
    //     return $this->belongsTo(Pengguna::class, 'username', 'username');
    // }

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'siswa_id');
    }

    public function nilaiAkhir($kelas_id)
    {
        return Nilai::where('siswa_id', $this->id)
            ->where('kelas_id', $kelas_id)
            ->avg('nilai');
    }
}
