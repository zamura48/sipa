<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendaftaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "pendaftarans";
    protected $fillable = ['periode_id', 'nama_ortu', 'alamat', 'telepon_ortu', 'jenis_kelamin_ortu', 'agama', 'nis', 'nama_siswa', 'jenis_kelamin_siswa', 'foto_siswa', 'status'];

    public function periode()
    {
        return $this->hasOne(Periode::class, 'id', 'periode_id');
    }
}
