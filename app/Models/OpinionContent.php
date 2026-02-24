<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpinionContent extends Model
{
    //

    protected $table = 'opinion_contents';

    protected $fillable = [
        'pages_id',
        'heading',
        'description',
    ];
}
