<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\LanguageCourseController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\WorkPermitController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Destinations (Countries) Routes - Enhanced with New Features
|--------------------------------------------------------------------------
*/
Route::prefix('destinations')->name('countries.')->group(function () {
    // Main listing page
    Route::get('/', [CountryController::class, 'index'])->name('index');
    
    // Search functionality (AJAX)
    Route::get('/search', [CountryController::class, 'search'])->name('search');
    
    // Compare countries (2-4 countries side-by-side)
    Route::get('/compare', [CountryController::class, 'compare'])->name('compare');
    
    // Filter countries
    Route::get('/filter', [CountryController::class, 'filter'])->name('filter');
    
    // Get featured countries (API/AJAX for homepage widgets)
    Route::get('/featured', [CountryController::class, 'featured'])->name('featured');
    
    // Admin: Statistics dashboard
    Route::get('/statistics', [CountryController::class, 'statistics'])
        ->name('statistics')
        ->middleware(['auth', 'admin']);
    
    // Admin: Clear country cache
    Route::post('/clear-cache', [CountryController::class, 'clearCache'])
        ->name('clear-cache')
        ->middleware(['auth', 'admin']);
    
    // Individual country detail page (MUST BE LAST TO AVOID CONFLICTS)
    Route::get('/{slug}', [CountryController::class, 'show'])->name('show');
    
    // AJAX endpoints for individual country data
    Route::prefix('{slug}')->name('ajax.')->group(function () {
        Route::get('/quick-stats', [CountryController::class, 'quickStats'])
            ->name('quick-stats');
        
        Route::get('/living-costs', [CountryController::class, 'livingCosts'])
            ->name('living-costs');
        
        Route::get('/visa-info', [CountryController::class, 'visaInfo'])
            ->name('visa-info');
    });
});

/*
|--------------------------------------------------------------------------
| Services Routes
|--------------------------------------------------------------------------
*/
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Blog Routes
|--------------------------------------------------------------------------
*/
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{slug}', [PostController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Pages Routes
|--------------------------------------------------------------------------
*/
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

/*
|--------------------------------------------------------------------------
| Gallery Routes
|--------------------------------------------------------------------------
*/
Route::redirect('/gallery', '/gallery/photos');
Route::prefix('gallery')->name('gallery.')->group(function () {
    Route::get('/photos', [MediaController::class, 'photos'])->name('photos');
    Route::get('/videos', [MediaController::class, 'videos'])->name('videos');
});

/*
|--------------------------------------------------------------------------
| Universities Routes
|--------------------------------------------------------------------------
*/
Route::get('/university/{slug}', [UniversityController::class, 'show'])
    ->name('universities.show');

/*
|--------------------------------------------------------------------------
| Language Courses Routes
|--------------------------------------------------------------------------
*/
Route::prefix('languages')->name('languages.')->group(function () {
    Route::get('/', [LanguageCourseController::class, 'index'])->name('index');
    Route::get('/{slug}', [LanguageCourseController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Scholarships Routes
|--------------------------------------------------------------------------
*/
Route::prefix('scholarships')->name('scholarships.')->group(function () {
    Route::get('/', [ScholarshipController::class, 'index'])->name('index');
    Route::get('/{slug}', [ScholarshipController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Careers Routes
|--------------------------------------------------------------------------
*/
Route::prefix('careers')->name('careers.')->group(function () {
    Route::get('/', [CareerController::class, 'index'])->name('index');
    Route::get('/{slug}', [CareerController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Work Permit Routes
|--------------------------------------------------------------------------
*/
Route::get('/work-permit/{slug}', [WorkPermitController::class, 'show'])
    ->name('work-permit.show');

/*
|--------------------------------------------------------------------------
| Search Routes
|--------------------------------------------------------------------------
*/
Route::get('/search', [SearchController::class, 'index'])->name('search');

/*
|--------------------------------------------------------------------------
| Form Submission Routes (POST)
|--------------------------------------------------------------------------
*/
Route::post('/inquiry/submit', [InquiryController::class, 'store'])
    ->name('inquiry.store');

Route::post('/career/apply', [JobApplicationController::class, 'store'])
    ->name('career.apply');

Route::post('/appointment/book', [AppointmentController::class, 'store'])
    ->name('appointment.store');

/*
|--------------------------------------------------------------------------
| Admin Routes (if not using Filament panel)
|--------------------------------------------------------------------------
*/
// Uncomment if you have custom admin routes
/*
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('sliders', SliderController::class);
});
*/