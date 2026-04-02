<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterContent extends Model
{
    public $table = 'inter_contents';

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title'
    ];

    public function subContents(){
         return $this->hasMany(InterSubContent::class, 'inter_contents_id');
    }
}
