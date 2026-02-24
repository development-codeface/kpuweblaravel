<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectorBanner extends Model
{
    //
    public $table = 'director_banners';

    protected $fillable = [
        'pages_id',
        'title',
        'button_text',
        'image',
        'created_at',
        'updated_at'
    ];
}
