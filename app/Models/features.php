<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class features extends Model
{
    public $table = 'features';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'title',
        'sub_title',
        'created_at',
        'updated_at'
    ];

    public function featureContents()
    {
        return $this->hasMany(FeatureContent::class, 'feature_id');
    }
}
