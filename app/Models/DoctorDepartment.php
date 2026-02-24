<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorDepartment extends Model
{
    public $table = 'doctor_departments';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'doctor_id',
        'department_id',
        'created_at',
        'updated_at'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
