<?php

namespace App\Providers;
use App\Models\GalleryCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        //
    View::share('galleryCategories', GalleryCategory::all());

	    require_once app_path('Helpers/BannerHelper.php');

    }
}
