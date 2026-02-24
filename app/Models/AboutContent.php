<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    //
    public $table = 'about_contents';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'pages_id',
        'heading',
        'logo_image',
        'content',
        'created_at',
        'updated_at',
    ];
}
