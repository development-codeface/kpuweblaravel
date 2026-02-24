<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutBlogSection extends Model
{
    //
    public $table = 'about_blog_sections';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'heading',
        'title',
        'created_at',
        'updated_at',
    ];
}
