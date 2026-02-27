<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurismContent extends Model
{
    public $table = 'turism_contents';

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title'
    ];

    public function subContents()
    {
        return $this->hasMany(TurismSubContent::class, 'turism_contents_id');
    }
}
