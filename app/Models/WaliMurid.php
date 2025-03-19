<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaliMurid extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "wali_murids";
    protected $fillable = ['nama', 'alamat', 'telepon', 'jenis_kelamin', 'agama'];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id', 'siswa_id');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id', 'siswa_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'wali_murid_id', 'id');
    }
}
