<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function canAccessFilament(): bool
    {
        return in_array($this->role, ['admin', 'pemilik']);
    }
}
