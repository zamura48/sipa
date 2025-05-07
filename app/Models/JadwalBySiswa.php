<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalBySiswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "jadwal_by_siswas";
    protected $fillable = ['jadwal_id', 'siswa_id'];

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'id', 'jadwal_id');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id', 'siswa_id');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id', 'siswa_id');
    }

    public function absensi()
    {
        return $this->hasOne(Absensi::class, 'jadwal_by_siswa_id', 'id');
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'jadwal_by_siswa_id', 'id');
    }
}
