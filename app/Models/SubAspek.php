<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAspek extends Model
{
    use HasFactory;

    protected $table = 'sub_aspek';

    protected $fillable = [
        'aspek_id',
        'nama',
        'deskripsi',
    ];

    public function aspek()
    {
        return $this->belongsTo(Aspek::class, 'aspek_id');
    }
}
