<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SpacialitySubContent;

class SpacialityContent extends Model
{
    public $table = 'spaciality_contents';

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
        'image',
    ];

    public function subContents()
    {
        return $this->hasMany(SpacialitySubContent::class, 'spaciality_contents_id');
    }
}
