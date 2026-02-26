<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurismBanner extends Model
{
    public $table = 'turism_banners';

    protected $fillable = [
        'pages_id',
        'title',
        'button_text',
        'description',
        'image'
    ];
}
