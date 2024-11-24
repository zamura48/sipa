<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use HasFactory, SoftDeletes;

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id', 'siswa_id');
    }

    public function iuran()
    {
        return $this->hasOne(Iuran::class, 'id', 'iuran_id');
    }
}
