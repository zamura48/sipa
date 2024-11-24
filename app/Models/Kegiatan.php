<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kegiatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kegiatans';
    protected $fillable = ['nama', 'tipe', 'keterangan'];

    public function pilihan()
    {
        return $this->hasOne(Pilihan::class, 'parameter', 'tipe')
            ->where('pilihans.nama', 'kegiatan');
    }
}
