<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpinionBanner extends Model
{
    //

    protected $table = 'opinion_banners';

    protected $fillable = [
        'pages_id',
        'image',
        'title',
        'description',
        'button_text',
    ];
}
