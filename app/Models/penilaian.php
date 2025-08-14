<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';

    protected $fillable = [
        'pendaftaran_id',
        'materi_id',
        'nilai',
        'grade',
        'predikat',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($penilaian) {
            if (!is_null($penilaian->nilai)) {
                // Tentukan Grade
                if ($penilaian->nilai >= 85) {
                    $penilaian->grade = 'A';
                    $penilaian->predikat = 'Sangat Baik';
                } elseif ($penilaian->nilai >= 75) {
                    $penilaian->grade = 'B';
                    $penilaian->predikat = 'Baik';
                } elseif ($penilaian->nilai >= 65) {
                    $penilaian->grade = 'C';
                    $penilaian->predikat = 'Cukup';
                } else {
                    $penilaian->grade = 'D';
                    $penilaian->predikat = 'Kurang';
                }
            }
        });
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
