<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\MenuLocations;
use App\Models\pages;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $route = request()->route();
            $routeName = $route ? $route->getName() : null;
            $pageSlugMap = [
                'home' => 'home',
                'about.index' => 'about',
                'career.index' => 'career',
                'pharmacy.index' => 'pharmacy',
                'ambulance.index' => 'ambulance',
                'blood_bank.index' => 'blood-bank',
                'directors.index' => 'directors',
                'insurance.index' => 'insurance',
                'health_packages.index' => 'health-packages',
                'icu.index' => 'icu',
                'second_opinion.index' => 'second-opinion',
                'spaciality.index' => ['specialities', 'speciality', 'spaciality'],
                'Specialities.index' => ['specialities', 'speciality', 'spaciality'],
                'rehab.index' => 'rehabilitation',
                'hospital-ot.index' => 'hospital-ot',
                'hospital-testing.index' => 'hospital-testing',
                'medical-turism.index' => 'medical-turism',
                'hospital-international.index' => 'hospital-international',
                'vision.index' => 'our-vision',
                'room.index' => 'rooms',
            ];

            $currentPage = null;
            if (isset($pageSlugMap[$routeName])) {
                $pageSlugs = (array) $pageSlugMap[$routeName];
                $currentPage = pages::with('seo')->whereIn('slug', $pageSlugs)->first();
            }

            $menus = MenuLocations::with('menuItems.submenus')
                ->whereIn('slug', ['main-menu', 'header-menu'])
                ->get()
                ->keyBy('slug'); // 🔥 use first, not get

            $view->with('menus', $menus);
            $view->with('currentSeoPage', $currentPage);
            $view->with('currentSeo', optional($currentPage)->seo);
        });
    }
}
