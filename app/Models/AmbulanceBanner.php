<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmbulanceBanner extends Model
{
    //
    public $table = 'ambulance_banners';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'pages_id',
        'title',
        'image',
        'button_text',
        'description',
        'created_at',
        'updated_at'
    ];
}
