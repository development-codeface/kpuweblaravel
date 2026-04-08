<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpacialityBanner extends Model
{
    public $table = 'spaciality_banners';

    protected $fillable = [
        'pages_id',
        'department_id',
        'title',
        'button_text',
        'description',
        'text',
        'image',
    ];
}
