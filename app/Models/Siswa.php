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
        'tanggal_lahir',
        'alamat',
        'kontak_hp',
        'foto',
        'id_jadwal',
        'nomor_siswa',
        'jenis_kelamin',
        'pendidikan_terakhir'
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
    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal'); // mengacu pada kolom 'jadwal' di tabel siswa
    }

    // Relasi ke Kelas melalui Jadwal
    public function kelas()
    {
        return $this->hasOneThrough(Kelas::class, Jadwal::class, 'id', 'id', 'id_jadwal', 'id'); // menghubungkan siswa, jadwal, dan kelas
    }
}
