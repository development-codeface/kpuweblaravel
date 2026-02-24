<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutBlog extends Model
{
    //
    //
    public $table = 'about_blogs';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'pages_id',
        'heading',
        'title',
        'image',
        'button_text',
        'button_link',
        'sub_heading',
        'description',
        'icon',
        'icon_heading',
        'icon_description',
        'status',
        'created_at',
        'updated_at',
    ];
}
