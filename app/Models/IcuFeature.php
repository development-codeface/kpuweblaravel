<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IcuFeature extends Model
{
    //

    protected $table = 'icu_features';

    protected $fillable = [
        'icu_contents_id',
        'title',
        'description',
    ];
}
