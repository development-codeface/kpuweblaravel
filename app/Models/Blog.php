<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
     public $table = 'blogs';

    protected $fillable = [
        'blog_category_id',
        'image',
        'title',
        'content'
    ];


    public function category(){
        return $this->belongsTo(BlogCategories::class,'blog_category_id');
    }
}
