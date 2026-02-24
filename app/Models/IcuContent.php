<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IcuContent extends Model
{
    //

    protected $table = 'icu_contents';

    protected $fillable = [
        'menus_id',
        'title',
        'description',
        'image',
        'sub_title',
        'sub_description',
    ];
}
