<?php

use App\Http\Controllers\NewspaperController as PublicNewspaperController;
use App\Http\Controllers\Admin\NewspaperController as AdminNewspaperController;
use App\Http\Controllers\Admin\NewspaperCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicNewspaperController::class, 'index'])->name('home');

// Admin panel routes
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Manage newspaper categories
        Route::resource('newspaper-categories', NewspaperCategoryController::class)
            ->except(['show']);

        // Manage newspapers
        Route::resource('newspapers', AdminNewspaperController::class)
            ->except(['show']);
    });