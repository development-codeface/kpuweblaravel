<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\MenuLocations;

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

            $menus = MenuLocations::with('menuItems.submenus')
                ->whereIn('slug', ['main-menu', 'header-menu'])
                ->get()
                ->keyBy('slug'); // 🔥 use first, not get

            $view->with('menus', $menus);
        });
    }
}
