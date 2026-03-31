<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IcuFeatureContent extends Model
{
    public $table = 'icu_feature_contents';

    protected $fillable = [
        'icu_feature_id',
        'icon',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
}
