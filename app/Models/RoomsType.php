<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SpecRooms;

class RoomsType extends Model
{
    public $table = 'rooms_types';

    protected $fillable = [
        'pages_id',
        'type',
        'image',
        'heading',
        'bed_count'
    ];

    public function specRooms()
    {
        return $this->hasMany(SpecRooms::class, 'rooms_types_id');
    }
}
