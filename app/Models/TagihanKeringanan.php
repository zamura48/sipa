<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagihanKeringanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tagihan_keringanans';
    protected $fillable = ['tagihan_id', 'keringanan_id', 'total_keringanan'];

    // tagihan, keringanan
    public function tagihan()
    {
        return $this->hasOne(Tagihan::class, 'id', 'tagihan_id');
    }

    public function keringanan()
    {
        return $this->hasOne(Keringanan::class, 'id', 'keringanan_id');
    }
}
