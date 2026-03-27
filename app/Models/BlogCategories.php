<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use RalphJSmit\Laravel\SEO\Models\SEO as SEOModel;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class BlogCategories extends Model
{
    public $table = 'blog_categories';

    protected $fillable = [
        'name',
    ];

    public function seo(): MorphOne
    {
        return $this->morphOne(SEOModel::class, 'model')->withDefault();
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->seo->title ?: $this->name,
            description: $this->seo->description,
            author: $this->seo->author,
            image: $this->seo->image,
            robots: $this->seo->robots,
            canonical_url: $this->seo->canonical_url
        );
    }
}
