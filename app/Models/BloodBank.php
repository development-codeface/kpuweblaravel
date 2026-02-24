<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodBank extends Model
{
    //
    public $table = 'blood_banks';
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
