<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalBySiswa extends Model
{
    use HasFactory, SoftDeletes;

    public function jadwalDetail()
    {
        return $this->hasOne(JadwalDetail::class, 'id', 'jadwal_detail_id');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id', 'siswa_id');
    }
}
