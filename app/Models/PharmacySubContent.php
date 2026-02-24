<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacySubContent extends Model
{
    //
    public $table = 'pharmacy_sub_contents';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'pharmacy_contents_id',
        'icon',
        'heading',
        'description',
        'created_at',
        'updated_at'
    ];
}
