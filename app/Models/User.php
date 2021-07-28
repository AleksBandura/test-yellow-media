<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable, HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email_name',
        'email',
        'email',
    ];

    protected $hidden = [
        'password',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}
