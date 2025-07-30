<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\LanguageController as AdminLanguageController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\StoryController as AdminStoryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\SocialIconController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/media', [MediaController::class, 'index'])->name('media');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/story/{id}', [StoryController::class, 'show'])->name('story.show');
Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/lang/{code}', [LanguageController::class, 'switch'])->name('lang.switch');
Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    // Add this route for video streaming
Route::get('/video/{filename}', [App\Http\Controllers\VideoStreamController::class, 'stream'])
    ->name('video.stream')
    ->where('filename', '.*\.(mp4|webm|ogg)$');

// Admin Auth Routes
Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    
    // Protected Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Content Management
        Route::resource('contents', ContentController::class);
        
        // Media Management
Route::resource('media', AdminMediaController::class)->parameters([
            'media' => 'medium'
        ]);        
        // Stories Management
        Route::resource('stories', AdminStoryController::class);

        
        // Partners Management
        Route::resource('partners', PartnerController::class);
        
        // Counters Management
        Route::resource('counters', CounterController::class);
        
        // Language Management
        // Route::resource('languages', AdminLanguageController::class)->except(['show', 'create', 'edit']);

        Route::resource('translations', TranslationController::class);
    Route::resource('social-icons', SocialIconController::class);
    });
});
