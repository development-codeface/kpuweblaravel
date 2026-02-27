<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurismSubContent extends Model
{
    public $table = 'turism_sub_contents';

    protected $fillable = [
        'turism_contents_id',
        'icon',
        'heading',
        'description'
    ];
}
