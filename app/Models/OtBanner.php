<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtBanner extends Model
{
    //

      protected $table = 'ot_banners';

    protected $fillable = [
        'pages_id',
        'image',
        'title',
        'description',
        'button_text',
    ];
}
