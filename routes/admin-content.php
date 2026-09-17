<?php

use App\Http\Controllers\Admin\Content\BlogCategoryController;
use App\Http\Controllers\Admin\Content\BlogPostController;
use App\Http\Controllers\Admin\Content\FaqController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Content\PageSectionController;
use App\Http\Controllers\Content\PageController as PublicPageController;
use Illuminate\Support\Facades\Route;

Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
Route::get('/pages/{page}/preview', [PublicPageController::class, 'preview'])->name('pages.preview');

Route::put('/pages/{page}/sections', [PageSectionController::class, 'updateAll'])->name('sections.update-all');
Route::put('/pages/{page}/sections/{section}', [PageSectionController::class, 'update'])->name('sections.update');
Route::post('/pages/{page}/sections/{section}/items', [PageSectionController::class, 'storeItem'])->name('section-items.store');
Route::put('/pages/{page}/sections/{section}/items/{item}', [PageSectionController::class, 'updateItem'])->name('section-items.update');
Route::delete('/pages/{page}/sections/{section}/items/{item}', [PageSectionController::class, 'destroyItem'])->name('section-items.destroy');

Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
Route::post('/faqs', [FaqController::class, 'store'])->name('faqs.store');
Route::put('/faqs/{faq}', [FaqController::class, 'update'])->name('faqs.update');
Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');

Route::resource('/blogs', BlogPostController::class)
    ->parameters(['blogs' => 'post'])
    ->except(['show']);
Route::get('/categories', [BlogCategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [BlogCategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{category}', [BlogCategoryController::class, 'update'])->name('categories.update');
