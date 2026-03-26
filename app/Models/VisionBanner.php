<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionBanner extends Model
{
    public $table = 'vision_banners';

    protected $fillable = [
        'pages_id',
        'button_text',
        'title',
        'image'
    ];
}
