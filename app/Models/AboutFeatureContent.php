<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutFeatureContent extends Model
{
    //
    public $table = 'about_feature_contents';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'about_feature_id',
        'icon',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
}
