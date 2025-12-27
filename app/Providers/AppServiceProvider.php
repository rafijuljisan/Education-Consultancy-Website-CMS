<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\MenuItem;
use App\Models\GeneralSetting;
use App\Models\Country; // Import Country Model
use App\Models\WorkPermit;
use App\Models\Gallery;
use App\Observers\GalleryObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gallery::observe(GalleryObserver::class);
        
        View::composer('*', function ($view) {
            $settings = GeneralSetting::first();

            $menu_items = MenuItem::whereNull('parent_id')
                ->with('children')
                ->orderBy('sort_order')
                ->get();

            // 1. Fetch Countries from Database (for the Dropdown)
            // We merge countries from the 'Country' model and 'WorkPermit' model to ensure all are listed
            $countries = Country::pluck('name')->toArray();
            $wp_countries = WorkPermit::where('is_active', true)->pluck('country')->toArray();

            // Merge, Unique, and Sort
            $all_countries = collect(array_merge($countries, $wp_countries))->unique()->sort()->values();

            $view->with('settings', $settings)
                ->with('menu_items', $menu_items)
                ->with('global_countries', $all_countries); // Pass to view
        });
    }
}
