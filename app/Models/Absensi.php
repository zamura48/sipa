<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use HasFactory, SoftDeletes;

    // siswa, jadwalbysiswa
    public function jadwalBySiswas()
    {
        return $this->hasMany(JadwalBySiswa::class, 'id', 'jadwal_by_siswa_id');
    }
}
