<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthPackageBlog extends Model
{
    //
      public $table = 'health_package_blogs';

    protected $fillable = [
        'pages_id',
        'category_id',
        'title',
        'sub_title',
        'name',
        'designation',
        'image',
        'created_at',
        'updated_at'
    ];
}
