<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecRooms extends Model
{
     public $table = 'spec_rooms';

    protected $fillable = [
        'rooms_types_id',
        'features'
    ];
}
