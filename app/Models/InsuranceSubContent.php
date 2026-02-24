<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceSubContent extends Model
{
    //
    public $table = 'insurance_sub_contents';

    protected $fillable = [
        'insurance_contents_id',
        'icon',
        'description',
        'created_at',
        'updated_at'
    ];
}
