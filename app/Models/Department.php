<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

class Department extends Model
{
    public $table = 'departments';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'created_at',
        'updated_at'
    ];


    public function doctors()
    {
        return $this->belongsToMany(
            Doctor::class,
            'doctor_departments',
            'department_id',
            'doctor_id'
        );
    }
}
