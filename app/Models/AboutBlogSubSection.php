<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutBlogSubSection extends Model
{
    //
    public $table = 'about_blog_sub_sections';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'image',
        'heading',
        'designation',
        'created_at',
        'updated_at',
    ];
}
