<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalTrip extends Model
{
    public $table = 'medical_trips';

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
    ];

     public function contents()
    {
        return $this->hasMany(MedicalTripContent::class, 'medical_trips_id');
    }

}
