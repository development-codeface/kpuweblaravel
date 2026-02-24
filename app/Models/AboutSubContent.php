<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSubContent extends Model
{
    //
    public $table = 'about_sub_contents';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
        'description',
        'created_at',
        'updated_at',
    ];
}
