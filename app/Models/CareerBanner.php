<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CareerBanner extends Model
{
    //
     use HasFactory;

    protected $table = 'career_banners';

    protected $fillable = [
        'pages_id',
        'button_text',
        'image',
        'title',
        'description'
    ];
}
