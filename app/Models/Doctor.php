<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Models\SEO as SEOModel;
use RalphJSmit\Laravel\SEO\Support\SEOData;

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

    public function seo(): MorphOne
    {
        return $this->morphOne(SEOModel::class, 'model')->withDefault();
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->seo->title ?: $this->name,
            description: $this->seo->description ?: Str::limit(trim(strip_tags($this->description ?? '')), 160),
            author: $this->seo->author,
            image: $this->seo->image ?: $this->image,
            articleBody: strip_tags($this->description ?? ''),
            section: $this->designation,
            type: 'profile',
            robots: $this->seo->robots,
            canonical_url: $this->seo->canonical_url
        );
    }

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
