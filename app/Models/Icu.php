<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icu extends Model
{
    //
    public $table = 'icus';

    protected $fillable = [
        'pages_id',
        'image',
        'title',
        'description',
        'button_text',
        'created_at',
        'updated_at'
    ];
}
