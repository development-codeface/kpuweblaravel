<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomBanner extends Model
{
    public $table = 'room_banners';

    protected $fillable = [
        'pages_id',
        'image',
        'title',
        'description',
        'button_text'
    ];
}
