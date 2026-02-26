<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceContent extends Model
{
    public $table = 'service_contents';

    protected $fillable = [
        'pages_id',
        'menus_id',
        'title',
        'description'
    ];
}
