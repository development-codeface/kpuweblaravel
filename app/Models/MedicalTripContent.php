<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalTripContent extends Model
{
    public $table = 'medical_trip_contents';

    protected $fillable = [
        'medical_trips_id',
        'heading',
        'description',
    ];

    public function trip()
    {
        return $this->belongsTo(MedicalTrip::class, 'medical_trips_id');
    }

    // One content has many sub contents
    public function subcontents()
    {
        return $this->hasMany(MedicalTripSubContent::class, 'medical_trip_contents_id');
    }
}
