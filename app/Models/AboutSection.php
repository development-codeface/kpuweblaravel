<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AboutSubSection;

class AboutSection extends Model
{
    //
    public $table = 'about_sections';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'pages_id',
        'heading',
        'title',
        'description',
        'created_at',
        'updated_at',
    ];

    public function subSection()
    {
        return $this->hasMany(AboutSubSection::class, 'about_section_id');
    }
}
