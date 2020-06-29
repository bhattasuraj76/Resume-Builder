<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function basicInfo()
    {
        return $this->hasOne(BasicInfo::class, 'user_id', 'id');
    }

    public function workDetails()
    {
        return $this->hasMany(WorkDetail::class, 'user_id', 'id');
    }

    public function skills()
    {
        return $this->hasMany(Skill::class, 'user_id', 'id');
    }

    public function education()
    {
        return $this->hasMany(Education::class, 'user_id', 'id');
    }

    public function references()
    {
        return $this->hasMany(Reference::class, 'user_id', 'id');
    }
}
