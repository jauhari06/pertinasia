<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Models\counter;

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
    public function boot()
    {
        // Load data secara global untuk semua views
        View::composer('*', function ($view) {
            $pageController = new PageController();
            $pageData = $pageController->loadPageData();
            
            // Membagikan data ke semua view
            $view->with($pageData);
        });
        $pengunjung = counter::whereBetween('tgl', [now()->subDays(30), now()])->get();
        $date = $pengunjung->pluck('tgl')->toArray();
        $viewer = $pengunjung->pluck('jml_pengunjung')->toArray();
    
        // Bagikan ke seluruh view
        View::share('date', $date);
        View::share('viewer', $viewer);
    }
}
