<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;

    protected $table = "penghunis";
    protected $fillable = ['siswa_id', 'kamar_id'];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id', 'siswa_id');
    }
}
