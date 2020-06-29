<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    protected $fillable = ['user_id', 'first_name', 'last_name', 'email', 'phone', 'street', 'postal_code', 'city', 'country'];

    public function getNameAttribute()
    {
        return $this->attributes['first_name'] . " " . $this->attributes['last_name'];
    }
}
