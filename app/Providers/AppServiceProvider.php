<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL; // Import URL Facade
use App\Models\MenuItem;
use App\Models\GeneralSetting;
use App\Models\Country;
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
        // 1. Force HTTPS in Production (Crucial for live server images/styles)
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // 2. Register Observers
        Gallery::observe(GalleryObserver::class);
        
        // 3. Share Global Variables with ALL Views
        View::composer('*', function ($view) {
            
            // A. Settings
            // Singleton pattern to prevent multiple DB queries on the same page load
            static $settings;
            if (!$settings) {
                $settings = GeneralSetting::first();
            }

            // B. Menu Items (Hierarchical & Active)
            static $menu_items;
            if (!$menu_items) {
                $menu_items = MenuItem::whereNull('parent_id')
                    ->where('is_active', true) // Only show active items
                    ->with(['children' => function($q) {
                        $q->where('is_active', true)->orderBy('sort_order'); // Only show active children
                    }])
                    ->orderBy('sort_order')
                    ->get();
            }

            // C. Global Countries List (For Appointment Dropdowns)
            static $all_countries;
            if (!$all_countries) {
                // Fetch basic countries
                // Note: If you added 'is_active' to countries table, uncomment the where clause
                $countries = Country::query()
                    // ->where('is_active', true) 
                    ->pluck('name')
                    ->toArray();

                // Fetch countries from Work Permits
                $wp_countries = WorkPermit::where('is_active', true)
                    ->pluck('country')
                    ->toArray();

                // Merge, Unique, Filter Empty, and Sort
                $all_countries = collect(array_merge($countries, $wp_countries))
                    ->unique()
                    ->filter() // Removes null/empty values
                    ->sort()
                    ->values();
            }

            // Pass variables to view
            $view->with('settings', $settings)
                 ->with('menu_items', $menu_items)
                 ->with('global_countries', $all_countries);
        });
    }
}