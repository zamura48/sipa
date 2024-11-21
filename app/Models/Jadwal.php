<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    public function jadwalDetails()
    {
        return $this->hasMany(JadwalDetail::class, 'jadwal_id', 'id');
    }
}
