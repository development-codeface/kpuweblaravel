<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionSection extends Model
{
    public $table = 'vision_sections';

    protected $fillable = [
        'pages_id',
        'heading',
        'icon',
        'description'
    ];
}
