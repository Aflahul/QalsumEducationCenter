<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikat';

    protected $fillable = [
        'pendaftaran_id',
        'nomor_sertifikat',
        'tanggal_terbit',
        'nilai_rata_rata',
        'predikat_kelulusan',
    ];

    public static function boot()
    {
        parent::boot();

        // Event otomatis sebelum sertifikat dibuat
        static::creating(function ($sertifikat) {
            // Ambil semua penilaian siswa di pendaftaran ini
            $penilaian = $sertifikat->pendaftaran->penilaian;

            if ($penilaian->count() > 0) {
                // Hitung rata-rata nilai
                $rataRata = $penilaian->avg('nilai');
                $sertifikat->nilai_rata_rata = $rataRata;

                // Tentukan predikat kelulusan berdasarkan rata-rata
                if ($rataRata >= 85) {
                    $sertifikat->predikat_kelulusan = 'Sangat Memuaskan';
                } elseif ($rataRata >= 75) {
                    $sertifikat->predikat_kelulusan = 'Memuaskan';
                } elseif ($rataRata >= 65) {
                    $sertifikat->predikat_kelulusan = 'Cukup';
                } else {
                    $sertifikat->predikat_kelulusan = 'Tidak Lulus';
                }
            }
        });
    }

    // Relasi ke pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
