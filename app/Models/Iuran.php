<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Iuran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'iurans';
    protected $fillable = ['nama', 'jenis_iuran_id', 'nama', 'total', 'keterangan'];

    public function jenisIuran()
    {
        return $this->hasOne(JenisIuran::class, 'id', 'jenis_iuran_id');
    }
}
