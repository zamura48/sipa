<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "absensis";
    protected $fillable = ['jadwal_by_siswa_id', 'absen', 'izin', 'masuk', 'tanggal', 'alasan'];

    // siswa, jadwalbysiswa
    public function jadwalBySiswas()
    {
        return $this->hasMany(JadwalBySiswa::class, 'id', 'jadwal_by_siswa_id');
    }

    // siswa, jadwalbysiswa
    public function jadwalBySiswa()
    {
        return $this->hasOne(JadwalBySiswa::class, 'id', 'jadwal_by_siswa_id');
    }
}
