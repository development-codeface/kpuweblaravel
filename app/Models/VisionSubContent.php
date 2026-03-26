<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionSubContent extends Model
{
    public $table = 'vision_sub_contents';

    protected $fillable = [
        'vision_contents_id',
        'image',
        'description'
    ];
}
