<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keringanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keringanans';
    protected $fillable = ['nama', 'keterangan', 'total', 'tipe'];

    public function pilihan()
    {
        return $this->hasOne(Pilihan::class, 'parameter', 'tipe')
            ->where('pilihans.nama', 'keringanan');
    }
}
