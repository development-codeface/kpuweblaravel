<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
     public $table = 'menus';

    protected $fillable = [
        'pages_id',
        'name',
        'description',
        'created_at',
        'updated_at'
    ];
}
