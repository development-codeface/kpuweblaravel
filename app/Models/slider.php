<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    public $table = 'sliders';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'image',
        'created_at',
        'updated_at'
    ];
}
