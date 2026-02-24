<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyContent extends Model
{
    //
    public $table = 'pharmacy_contents';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'pages_id',
        'title',
        'sub_title',
        'description',
        'button_text',
        'created_at',
        'updated_at'
    ];

    public function subContents()
    {
        return $this->hasMany(PharmacySubContent::class, 'pharmacy_contents_id');
    }
}
