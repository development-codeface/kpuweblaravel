<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectorContent extends Model
{
    //
    public $table = 'director_contents';

    protected $fillable = [
        'pages_id',
        'title',
        'description',
        'created_at',
        'updated_at'
    ];

    public function directorBlog()
    {
        return $this->hasMany(DirectorBlog::class, 'director_contents_id', 'id');
    }
}
