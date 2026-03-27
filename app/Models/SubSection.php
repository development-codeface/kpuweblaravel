<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSection extends Model
{
    public $table = 'sub_sections';

    protected $fillable = [
        'sections_id',
        'name',
        'description',
        'image'
    ];
}
