<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Models\SEO as SEOModel;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Facility extends Model
{
    public $table = 'facilities';

    protected $fillable = [
        'title',
        'sub_title'
    ];

    public function seo(): MorphOne
    {
        return $this->morphOne(SEOModel::class, 'model')->withDefault();
    }

    public function getDynamicSEOData(): SEOData
    {
        $fallbackImage = $this->content()->whereNotNull('image')->value('image');

        return new SEOData(
            title: $this->seo->title ?: $this->title,
            description: $this->seo->description ?: Str::limit(trim(strip_tags($this->sub_title ?? '')), 160),
            author: $this->seo->author,
            image: $this->seo->image ?: ($fallbackImage ? 'images/facility/' . $fallbackImage : null),
            robots: $this->seo->robots,
            canonical_url: $this->seo->canonical_url
        );
    }

    public function content()
    {
        return $this->hasMany(FacilityContent::class, 'facilities_id');
    }
}
