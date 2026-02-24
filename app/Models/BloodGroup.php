<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    //
    public $table = 'blood_groups';

    protected $fillable = [
        'pages_id',
        'blood_group',
        'status',
        'created_at',
        'updated_at',
    ];
}
