<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceContent extends Model
{
    //
    public $table = 'insurance_contents';

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
        'created_at',
        'updated_at'
    ];

    public function subContents()
    {
        return $this->hasMany(InsuranceSubContent::class, 'insurance_contents_id');
    }
}
