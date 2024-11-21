<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    public function kamar()
    {
        return $this->hasOne(Kamar::class, 'id', 'kamar_id');
    }

    public function peirode()
    {
        return $this->hasOne(Periode::class, 'id', 'periode_id');
    }
}
