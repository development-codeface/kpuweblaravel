<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyPlansContent extends Model
{
    //
    public $table = 'pharmacy_plans_contents';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'pages_id',
        'basic_plan',
        'standard_plan',
        'created_at',
        'updated_at'
    ];
}
