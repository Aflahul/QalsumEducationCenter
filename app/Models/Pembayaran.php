<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pendaftaran_kelas_id',
        'jumlah_bayar',
        'bukti_pembayaran',
        'status',
    ];

    // Relasi ke tabel PendaftaranKelas
    public function pendaftaranKelas() {
    return $this->belongsTo(PendaftaranKelas::class);
}

}
