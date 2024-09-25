<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        
        'nomor_siswa',
        'nama',
        'id_jadwal',
        'tanggal_lahir',
        'alamat',
        'kontak_hp',
        'pendidikan_terakhir',
        'jenis_kelamin',
        'foto',
    ];

    // public function pengguna()
    // {
    //     return $this->belongsTo(Pengguna::class, 'username', 'username');
    // }

   
   
    
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
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_siswa');
    }
    

    // Relasi dengan Penilaian Kelas
    public function penilaianKelas()
    {
        return $this->hasMany(PenilaianKelas::class, 'id_siswa');
    }

    // Relasi dengan Nilai
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_siswa');
    }
    public function sertifikat()
{
    return $this->hasOne(Sertifikat::class, 'id_siswa');
}

}
