<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmbulanceContent extends Model
{
    public $table = 'ambulance_contents';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'pages_id',
        'title',
        'image',
        'sub_title',
        'sub_description',
        'description',
        'number',
        'created_at',
        'updated_at'
    ];

    public function sub_content()
    {
        return $this->hasMany(AmbulanceSubContent::class, 'ambulance_contents_id', 'id');
    }
}
