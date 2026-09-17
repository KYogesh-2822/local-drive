<?php

use App\Http\Controllers\Content\PageController;
use App\Http\Controllers\Content\SitemapController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

$managedPages = config('content.system_pages', []);
$managedPageSlugs = array_keys($managedPages);
$locationPageSlugs = array_keys(array_filter(
    $managedPages,
    fn (array $page) => ($page['template'] ?? null) === 'location'
));

if (config('content.managed_pages_live')) {
    Route::get('/', [PageController::class, 'home'])->name('content.home');

    Route::get('/{page}', [PageController::class, 'location'])
        ->whereIn('page', $locationPageSlugs)
        ->name('content.locations.show');

    Route::get('/new-{page}', [PageController::class, 'redirectPreview'])
        ->whereIn('page', $managedPageSlugs)
        ->name('content.review.show');

    Route::get('/locations/{page}', [PageController::class, 'redirectLegacyLocation'])
        ->whereIn('page', $locationPageSlugs)
        ->name('content.locations.legacy');
} else {
    Route::get('/new-{page}', [PageController::class, 'preview'])
        ->whereIn('page', $managedPageSlugs)
        ->name('content.review.show');

    Route::get('/', [HomeController::class, 'index'])->name('home');
}

Route::get('/sitemap.xml', SitemapController::class)->name('content.sitemap');