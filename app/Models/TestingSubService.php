<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestingSubService extends Model
{
    public $table = 'testing_sub_services';

    protected $fillable = [
        'testing_services_id',
        'heading',
        'description'
    ];
}
