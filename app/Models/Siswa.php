<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    public function kamar()
    {
        return $this->hasOne(Kamar::class, 'id', 'kamar_id');
    }

    public function peirode()
    {
        return $this->hasOne(Periode::class, 'id', 'periode_id');
    }
}
