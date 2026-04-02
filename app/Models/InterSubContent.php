<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterSubContent extends Model
{
     public $table = 'inter_sub_contents';

    protected $fillable = [
        'inter_contents_id',
        'text',
    ];
}
