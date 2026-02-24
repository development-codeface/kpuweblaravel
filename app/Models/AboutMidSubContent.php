<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutMidSubContent extends Model
{
    //
    public $table = 'about_mid_sub_contents';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'about_mid_content_id',
        'title',
        'icon',
        'description',
        'image',
        'created_at',
        'updated_at',
    ];
}
