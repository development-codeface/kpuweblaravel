<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalTripSubContent extends Model
{
    public $table = 'medical_trip_sub_contents';

    protected $fillable = [
        'medical_trip_contents_id',
        'text'
    ];

    // Belongs to content
    public function content()
    {
        return $this->belongsTo(MedicalTripContent::class, 'medical_trip_contents_id');
    }
}
