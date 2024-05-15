<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Document;
use App\Observers\CategoryObserver;
use App\Observers\DocumentObserver;
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
        Document::observe(new DocumentObserver());
        Category::observe(new CategoryObserver());
    }
}
