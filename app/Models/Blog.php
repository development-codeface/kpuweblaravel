<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Models\SEO as SEOModel;
use RalphJSmit\Laravel\SEO\Support\SEOData;

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

    public function seo(): MorphOne
    {
        return $this->morphOne(SEOModel::class, 'model')->withDefault();
    }

     public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->seo->title ?: $this->title,
            description: $this->seo->description ?: Str::limit(trim(strip_tags($this->content ?? '')), 160),
            author: $this->seo->author,
            image: $this->seo->image ?: $this->image,
            articleBody: strip_tags($this->content ?? ''),
            section: $this->category?->name,
            type: 'article',
            robots: $this->seo->robots,
            canonical_url: $this->seo->canonical_url
        );
    }
}
