<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureSubService extends Model
{
    public $table = 'feature_sub_services';

    protected $fillable = [
        'feature_services_id',
        'heading',
        'description',
    ];
}
