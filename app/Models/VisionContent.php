<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VisionSubContent;

class VisionContent extends Model
{
    public $table = 'vision_contents';

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
    ];

    public function subContent()
    {
        return $this->hasMany(VisionSubContent::class, 'vision_contents_id');
    }
}
