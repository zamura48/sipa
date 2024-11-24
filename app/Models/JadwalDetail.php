<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalDetail extends Model
{
    use HasFactory, SoftDeletes;

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'id', 'jadwal_id');
    }

    public function kegiatan()
    {
        return $this->hasOne(Kegiatan::class, 'id', 'kegiatan_id');
    }

    public function jadwalBySiswas()
    {
        return $this->hasMany(JadwalBySiswa::class, 'jadwal_detail_id', 'id');
    }
}
