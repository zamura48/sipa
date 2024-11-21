<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    use HasFactory;

    public function jenisIuran()
    {
        return $this->hasOne(JenisIuran::class, 'id', 'jenis_iuran_id');
    }
}
