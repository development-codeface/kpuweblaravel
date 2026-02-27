<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpacialitySubContent extends Model
{
    public $table = 'spaciality_sub_contents';

    protected $fillable = [
        'spaciality_contents_id',
        'heading',
        'description'
    ];
}
