<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestingBanner extends Model
{
    public $table = 'testing_banners';

    protected $fillable = [
        'pages_id',
        'title',
        'button_text',
        'description',
        'image'
    ];
}
