<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "jadwals";
    protected $fillable = ['hari', 'nama', 'jam', 'keterangan'];

    public function jadwalDetails()
    {
        return $this->hasMany(JadwalDetail::class, 'jadwal_id', 'id');
    }
}
