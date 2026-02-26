<?php

namespace App\Models;

use App\Models\FeatureSubService;

use Illuminate\Database\Eloquent\Model;

class FeatureService extends Model
{
    public $table = 'feature_services';

    protected $fillable = [
        'pages_id',
        'title',
        'description',
        'image',
    ];


    public function subContents()
    {
        return $this->hasMany(FeatureSubService::class, 'feature_services_id');
    }
}
