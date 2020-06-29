<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = ['user_id', 'institution', 'area', 'study_type', 'gpa', 'start_date', 'end_date'];

    protected $dates = ['start_date', 'end_date'];
}
