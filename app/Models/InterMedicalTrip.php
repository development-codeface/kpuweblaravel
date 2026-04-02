<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterMedicalTrip extends Model
{
    public $table = 'inter_medical_trips';

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
    ];

    public function contents()
    {
        return $this->hasMany(InterMedicalTripContent::class, 'inter_medical_trips_id');
    }
}
