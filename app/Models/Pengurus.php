<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengurus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "penguruses";
    protected $fillable = ['nama', 'alamat', 'telepon', 'jenis_kelamin', 'agama'];

    public function user()
    {
        return $this->hasOne(User::class, 'pengurus_id', 'id');
    }
}
