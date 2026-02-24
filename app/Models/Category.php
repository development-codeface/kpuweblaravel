<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'parent_category',
        'description',
        'banner_image',
        'category_subtitle',
        'subtitle_description',

    ];

    public function bannerSliders()
    {
        return $this->hasMany(BannerSlider::class, 'category_id');
    }
}
