<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "siswas";
    protected $fillable = ['periode_id', 'kamar_id', 'nis', 'nama', 'jenis_kelamin', 'foto'];

    public function kamar()
    {
        return $this->hasOne(Kamar::class, 'id', 'kamar_id');
    }

    public function peirode()
    {
        return $this->hasOne(Periode::class, 'id', 'periode_id');
    }
}
