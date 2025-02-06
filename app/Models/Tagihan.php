<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tagihans';
    protected $fillable = ['siswa_id', 'iuran_id', 'jatuh_tempo', 'total_tagihan', 'total_semua_keringanan', 'total_semua', 'nominal_bayar', 'bukti_bayar', 'status'];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id', 'siswa_id');
    }

    public function iuran()
    {
        return $this->hasOne(Iuran::class, 'id', 'iuran_id');
    }
}
