<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestingService extends Model
{
    public $table = 'testing_services';

    protected $fillable = [
        'pages_id',
        'title',
        'description',
        'image'
    ];

    public function subContents()
    {
        return $this->hasMany(TestingSubService::class, 'testing_services_id');
    }
}
