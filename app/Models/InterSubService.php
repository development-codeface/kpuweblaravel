<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterSubService extends Model
{
     public $table = 'inter_sub_services';

    protected $fillable = [
        'inter_services_id',
        'heading',
        'description'
    ];
}
