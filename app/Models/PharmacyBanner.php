<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyBanner extends Model
{
    //
     public $table = 'pharmacy_banners';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'pages_id',
        'title',
        'button_text',
        'image',
        'created_at',
        'updated_at'
    ];
}
