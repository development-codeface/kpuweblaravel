<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internationalbanner extends Model
{
    public $table = 'internationalbanners';

    protected $fillable = [
        'pages_id',
        'title',
        'button_text',
        'description',
        'image'
    ];
}
