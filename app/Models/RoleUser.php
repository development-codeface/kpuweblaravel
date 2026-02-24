<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
     public $table = 'role_user';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'role_id',
        'user_id'
    ];
}
