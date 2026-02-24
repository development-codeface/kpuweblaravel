<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodBankSubContent extends Model
{
    //
      public $table = 'blood_bank_sub_contents';

    protected $fillable = [
        'blood_bank_contents_id',
        'heading',
        'text',
        'created_at',
        'updated_at'
    ];
}
