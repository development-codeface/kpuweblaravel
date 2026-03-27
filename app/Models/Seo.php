<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    public $table = 'seo';

    protected $fillable = [
        'title',
        'description',
        'image',
        'author',
        'robots',
        'canonical_url',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
