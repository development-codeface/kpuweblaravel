<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class pages extends Model
{
    public $table = 'pages';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'title',
        'slug',
        'created_at',
        'updated_at'
    ];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'model');
    }

    public function adminBuilderRouteName(): ?string
    {
        $routeMap = [
            'home' => 'admin.home.create',
            'about' => 'admin.about.create',
            'career' => 'admin.career.create',
            'pharmacy' => 'admin.pharmacy.create',
            'ambulance' => 'admin.ambulance.create',
            'blood-bank' => 'admin.blood_bank.create',
            'blood_bank' => 'admin.blood_bank.create',
            'directors' => 'admin.directors.create',
            'health-packages' => 'admin.health-packages.create',
            'health_packages' => 'admin.health-packages.create',
            'insurance' => 'admin.insurance.create',
            'icu' => 'admin.icu.create',
            'second-opinion' => 'admin.second-opinion.create',
            'second_opinion' => 'admin.second-opinion.create',
            'spaciality' => 'admin.spaciality.create',
            'rehab' => 'admin.rehabilitation.create',
            'rehabilitation' => 'admin.rehabilitation.create',
            'hospital-ot' => 'admin.hospital-ot.create',
            'hospital-testing' => 'admin.hospital-testing.create',
            'medical-turism' => 'admin.medical-turism.create',
            'hospital-international' => 'admin.hospital-international.create',
            'vision' => 'admin.our-vision.create',
            'our-vision' => 'admin.our-vision.create',
            'room' => 'admin.rooms.create',
            'rooms' => 'admin.rooms.create',
            'service' => 'admin.service.create'
        ];

        $routeName = $routeMap[$this->slug] ?? null;

        if (!$routeName || !Route::has($routeName)) {
            return null;
        }

        return $routeName;
    }

    public function adminBuilderUrl(): ?string
    {
        $routeName = $this->adminBuilderRouteName();

        return $routeName ? route($routeName, $this->id) : null;
    }
}
