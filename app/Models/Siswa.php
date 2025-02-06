<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "siswas";
    protected $fillable = ['pengguna_id', 'periode_id', 'kamar_id', 'nis', 'nama', 'jenis_kelamin', 'foto'];

    public function kamar()
    {
        return $this->hasOne(Kamar::class, 'id', 'kamar_id');
    }

    public function periode()
    {
        return $this->hasOne(Periode::class, 'id', 'periode_id');
    }

    public function ortu()
    {
        return $this->hasOne(Pengguna::class, 'id', 'pengguna_id');
    }

    public function sekolah()
    {
        return $this->hasOne(Sekolah::class, 'id', 'sekolah_id');
    }
}
