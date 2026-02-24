<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutBanner extends Model
{
    //
      public $table = 'about_banners';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'pages_id',
        'title',
        'image',
        'button_text',
        'status',
        'created_at',
        'updated_at',
    ];
}
