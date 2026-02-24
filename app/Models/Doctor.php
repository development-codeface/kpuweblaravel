<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public $table = 'doctors';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'designation',
        'image',
        'status',
        'created_at',
        'updated_at'
    ];

    // public function doctorDepartments()
    // {
    //     return $this->hasMany(DoctorDepartment::class, 'doctor_id');
    // }

    public function doctorDepartments()
    {
        return $this->hasMany(DoctorDepartment::class, 'doctor_id');
    }


    public function departments()
    {
        return $this->belongsToMany(
            Department::class,
            'doctor_departments',
            'doctor_id',
            'department_id'
        );
    }
}
