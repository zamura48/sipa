<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kamar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "kamars";
    protected $fillable = ['nama', 'jumlah_penghuni', 'jenis'];

    public function penghuni()
    {
        return $this->hasOne(Penghuni::class, 'kamar_id', 'id');
    }

    public function penghunis()
    {
        return $this->hasMany(Penghuni::class, 'kamar_id', 'id');
    }
}
