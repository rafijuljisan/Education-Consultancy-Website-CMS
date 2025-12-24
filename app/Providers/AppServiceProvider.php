<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\MenuItem;
use App\Models\GeneralSetting;

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
        // 3. Share 'settings' and 'menu_items' with ALL views automatically
        View::composer('*', function ($view) {
            
            // Get Site Settings (Cache it for performance if needed, but this is fine for now)
            $settings = GeneralSetting::first();

            // Get Menu Items (Parents with Children)
            $menu_items = MenuItem::whereNull('parent_id')
                            ->with('children')
                            ->orderBy('sort_order')
                            ->where('is_active', true)
                            ->get();

            // Pass them to the view
            $view->with('settings', $settings)
                 ->with('menu_items', $menu_items);
        });
    }
}
