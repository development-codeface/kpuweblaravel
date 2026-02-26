<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RehabBanner extends Model
{

    public $table = 'rehab_banners';

    protected $fillable = [
        'title',
        'pages_id',
        'button_text',
        'description',
        'image'
    ];
}
