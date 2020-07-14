<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    protected $fillable = ['user_id', 'first_name', 'last_name', 'email', 'phone', 'postal_code', 'street', 'city', 'country', 'profession_title', 'profession_summary'];

    public function getNameAttribute()
    {
        return $this->attributes['first_name'] . " " . $this->attributes['last_name'];
    }
}
