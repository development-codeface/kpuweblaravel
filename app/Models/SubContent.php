<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubContent extends Model
{
     public $table = 'sub_contents';

    protected $fillable = [
        'contents_id',
        'title',
        'image',
        'image_2',
        'image_3',
        'description'
    ];
}
