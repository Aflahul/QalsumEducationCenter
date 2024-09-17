<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspek extends Model
{
    use HasFactory;

    protected $table = 'aspek';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function subAspeks()
    {
        return $this->hasMany(SubAspek::class, 'aspek_id');
    }
}
