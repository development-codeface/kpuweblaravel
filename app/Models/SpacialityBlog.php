<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpacialityBlog extends Model
{
    public $table = 'spaciality_blogs';

    protected $fillable = [
        'pages_id',
        'icon',
        'title',
        'description'
    ];
}
