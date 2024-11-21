<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanKeringanan extends Model
{
    use HasFactory;

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
