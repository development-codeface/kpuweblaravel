<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmbulanceSubContent extends Model
{
    //
    public $table = 'ambulance_sub_contents';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'ambulance_contents_id',
        'title',
        'description',
        'created_at',
        'updated_at'
    ];
}
