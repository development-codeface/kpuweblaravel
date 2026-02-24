<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSubSection extends Model
{
    //
    public $table = 'about_sub_sections';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'about_section_id',
        'title',
        'icon',
        'description',
        'created_at',
        'updated_at',
    ];
}
