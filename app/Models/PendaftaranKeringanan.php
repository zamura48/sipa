<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendaftaranKeringanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "pendaftaran_keringanan";
    protected $fillable = ['pendaftaran_id', 'keringanan_id', 'dokumen_pendukung', 'status_pengajuan'];

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class, 'id', 'pendaftaran_id');
    }

    public function keringanan()
    {
        return $this->hasOne(Keringanan::class, 'id', 'keringanan_id');
    }
}
