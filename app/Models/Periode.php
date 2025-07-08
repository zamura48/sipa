<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "periodes";
    protected $fillable = ['tgl_mulai', 'tgl_akhir', 'nama', 'status', 'kapasitas'];
}
