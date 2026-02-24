<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IcuSubContent extends Model
{
    //

    protected $table = 'icu_sub_contents';

    protected $fillable = [
        'icu_contents_id',
        'text',
    ];
}
