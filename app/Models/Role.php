<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guard = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'role_id', 'id');
    }
}
