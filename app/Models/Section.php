<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $table = 'sections';

    protected $fillable = [
        'pages_id',
        'image',
        'heading',
        'sub_heading',
        'title',
        'sub_title'
    ];

    public function subContent()
    {
        return $this->hasMany(SubSection::class, 'sections_id', 'id');
    }
}
