<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pages extends Model
{
    public $table = 'pages';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'title',
        'slug',
        'created_at',
        'updated_at'
    ];
}
