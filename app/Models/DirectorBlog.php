<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectorBlog extends Model
{
    //
    public $table = 'director_blogs';

    protected $fillable = [
        'director_contents_id',
        'heading',
        'designation',
        'image',
        'text',
        'created_at',
        'updated_at'
    ];
}
