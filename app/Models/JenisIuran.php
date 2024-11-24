<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisIuran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "jenis_iurans";
    protected $fillable = ['nama', 'keterangan'];
}
