<?php

use App\Http\Controllers\Content\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/blog', [BlogController::class, 'index'])->name('content.blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('content.blog.show');
