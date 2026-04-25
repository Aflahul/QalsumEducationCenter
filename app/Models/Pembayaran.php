<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pembayaran';

    protected $fillable = [
        'id_pendaftaran', // Relasi ke tabel pendaftaran
        'tanggal_bayar',  // Tanggal pembayaran
        'jumlah',         // Jumlah yang dibayar
        'biaya_total',
        'sisa_pembayaran',
        'angsuran_ke',    // 1 atau 2
        'bukti_pembayaran', // Path/file bukti pembayaran
        'status'          // pending, diterima, ditolak
    ];

    /**
     * Relasi ke model Pendaftaran
     */
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }

    /**
     * Relasi ke model Siswa (melalui Pendaftaran)
     */
    public function siswa()
    {
        return $this->hasOneThrough(
            Siswa::class,
            Pendaftaran::class,
            'id', // Key on pendaftaran
            'id', // Key on siswa
            'id_pendaftaran', // Key on pembayaran
            'id_siswa' // Key on pendaftaran
        );
    }
}
