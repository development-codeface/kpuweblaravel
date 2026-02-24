<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureContent extends Model
{
    public $table = 'feature_contents';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'feature_id',
        'icon',
        'name',
        'description',
        'created_at',
        'updated_at'
    ];
}
