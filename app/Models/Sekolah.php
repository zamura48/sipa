<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sekolah extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "sekolahs";
    protected $fillable = ['nama_sekolah'];

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'sekolah_id', 'id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'sekolah_id', 'id');
    }
}
