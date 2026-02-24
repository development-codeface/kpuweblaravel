<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AboutFeatureContent;

class AboutFeature extends Model
{
    //
    public $table = 'about_features';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
        'created_at',
        'updated_at',
    ];

    public function featureContents()
    {
        return $this->hasMany(AboutFeatureContent::class, 'about_feature_id');
    }
}
