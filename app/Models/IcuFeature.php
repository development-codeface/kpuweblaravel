<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IcuFeature extends Model
{
    public $table = 'icu_features';

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
        'created_at',
        'updated_at',
    ];

    public function featureContents()
    {
        return $this->hasMany(IcuFeatureContent::class, 'icu_feature_id');
    }
}
