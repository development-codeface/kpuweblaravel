<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerContent extends Model
{
    public $table = 'career_contents';
    protected $fillable = [
        'pages_id',
        'title',
        'image',
        'job_type',
        'work_mode',
        'salary_min',
        'salary_max',
        'salary_type',
        'location',
        'icon',
        'created_at',
        'updated_at',
    ];
}
