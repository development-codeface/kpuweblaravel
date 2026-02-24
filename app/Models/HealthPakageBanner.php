<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthPakageBanner extends Model
{
    //
    public $table = 'health_pakage_banners';

    protected $fillable = [
        'pages_id',
        'image',
        'title',
        'description',
        'button_text',
        'created_at',
        'updated_at'
    ];
}
