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
use App\Http\Controllers\Admin\DashboardController; // Assuming you have this

// 1. Home Route - WE ADDED ->name('home') HERE
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Destinations Routes
Route::get('/destinations', [CountryController::class, 'index'])->name('countries.index');
Route::get('/destinations/{slug}', [CountryController::class, 'show'])->name('countries.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::redirect('/gallery', '/gallery/photos');
Route::get('/gallery/photos', [MediaController::class, 'photos'])->name('gallery.photos');
Route::get('/gallery/videos', [MediaController::class, 'videos'])->name('gallery.videos');
Route::get('/university/{slug}', [UniversityController::class, 'show'])->name('universities.show');
Route::get('/languages', [LanguageCourseController::class, 'index'])->name('languages.index');
Route::get('/languages/{slug}', [LanguageCourseController::class, 'show'])->name('languages.show');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{slug}', [CareerController::class, 'show'])->name('careers.show');
Route::post('/inquiry/submit', [InquiryController::class, 'store'])->name('inquiry.store');
Route::post('/career/apply', [JobApplicationController::class, 'store'])->name('career.apply');
Route::post('/appointment/book', [AppointmentController::class, 'store'])->name('appointment.store');
Route::get('/work-permit/{slug}', [WorkPermitController::class, 'show'])->name('work-permit.show');
Route::get('/scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/scholarships/{slug}', [ScholarshipController::class, 'show'])->name('scholarships.show');

