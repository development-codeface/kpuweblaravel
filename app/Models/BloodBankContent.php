<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodBankContent extends Model
{

  public $table = 'blood_bank_contents';

    protected $fillable = [
        'pages_id',
        'title',
        'description',
        'created_at',
        'updated_at'
    ];

    public function sub_content()
    {
        return $this->hasMany(BloodBankSubContent::class, 'blood_bank_contents_id', 'id');
    }
}
