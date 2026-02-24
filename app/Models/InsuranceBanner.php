<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceBanner extends Model
{
    //
    public $table = 'insurance_banners';

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
