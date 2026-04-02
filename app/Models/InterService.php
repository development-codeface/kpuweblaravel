<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterService extends Model
{
     public $table = 'inter_services';

    protected $fillable = [
        'pages_id',
        'title',
        'description',
        'image'
    ];

    public function subContents()
    {
        return $this->hasMany(InterSubService::class, 'inter_services_id');
    }
}
