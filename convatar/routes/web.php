
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewspaperController as PublicNewspaperController;
use App\Http\Controllers\Admin\NewspaperController as AdminNewspaperController;
use App\Http\Controllers\Admin\NewspaperCategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ConverterController;
use App\Http\Middleware\TrackVisitors;

// Public website routes with visitor tracking
Route::middleware(TrackVisitors::class)->group(function () {

    // Homepage
    Route::get('/', [PublicNewspaperController::class, 'index'])
        ->name('home');

    // Bangla Converter
    Route::get('/convatar', [ConverterController::class, 'index'])
        ->name('convatar.index');

});

// Login routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store');

    // Registration routes
    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');

});

// Logout route
Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

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




