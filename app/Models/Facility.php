<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    //
    public $table = 'facilities';

    protected $fillable = [
        'title',
        'sub_title'
    ];


    public function content()
    {
        return $this->hasMany(FacilityContent::class, 'facilities_id');
    }
}
