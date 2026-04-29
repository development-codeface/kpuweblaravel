<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpacialityFeatureContent extends Model
{
    public $table = 'spaciality_feature_contents';

    protected $fillable = [
        'spaciality_feature_id',
        'icon',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
}
