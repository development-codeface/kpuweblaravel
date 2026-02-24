<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyPlans extends Model
{
    //
        public $table = 'pharmacy_plans';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
        'from_time',
        'to_time',
        'created_at',
        'updated_at'
    ];
}
