<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthPackagecontent extends Model
{
    //
    public $table = 'health_packagecontents';

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
        'created_at',
        'updated_at'
    ];
}
