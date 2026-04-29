<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpacialityFeature extends Model
{
    public $table = 'spaciality_features';

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
        'created_at',
        'updated_at',
    ];

    public function featureContents()
    {
        return $this->hasMany(SpacialityFeatureContent::class, 'spaciality_feature_id');
    }
}
