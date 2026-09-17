<?php

namespace App\Providers;

use App\Models\Content\BlogPost;
use App\Models\Content\ContentPage;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        Relation::enforceMorphMap([
            'page' => ContentPage::class,
            'blog' => BlogPost::class,
        ]);
    }
}
