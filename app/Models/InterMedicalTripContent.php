<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterMedicalTripContent extends Model
{
    public $table = 'inter_medical_trip_contents';

    protected $fillable = [
        'inter_medical_trips_id',
        'heading',
        'description',
    ];

    public function trip()
    {
        return $this->belongsTo(InterMedicalTrip::class, 'inter_medical_trips_id');
    }

    public function subcontents()
    {
        return $this->hasMany(InterMedicalTripSubContent::class, 'inter_medical_trip_contents_id');
    }
}
