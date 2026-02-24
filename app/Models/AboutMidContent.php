<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AboutMidSubContent;

class AboutMidContent extends Model
{
    //
    public $table = 'about_mid_contents';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'pages_id',
        'title',
        'created_at',
        'updated_at',
    ];

    public function aboutMidSubContent()
    {
        return $this->hasMany(AboutMidSubContent::class, 'about_mid_content_id');
    }
}
