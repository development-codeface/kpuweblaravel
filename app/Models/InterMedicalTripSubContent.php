<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterMedicalTripSubContent extends Model
{
    public $table = 'inter_medical_trip_sub_contents';

    protected $fillable = [
        'inter_medical_trip_contents_id',
        'text',
    ];

    public function content()
    {
        return $this->belongsTo(InterMedicalTripContent::class, 'inter_medical_trip_contents_id');
    }
}
