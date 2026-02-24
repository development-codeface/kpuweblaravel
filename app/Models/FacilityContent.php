<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityContent extends Model
{
    //
       public $table = 'facility_contents';

    protected $fillable = [
        'facilities_id',
        'heading',
        'image',
        'button_text'
    ];
}
