<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Course;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\GeneralSetting;
use App\Models\Post;
use App\Models\Video;
use App\Models\Slider;
use App\Models\Affiliate;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            // 0. Hero Sliders (Check if 'is_active' exists in your sliders table, otherwise remove where clause)
            'sliders' => Slider::orderBy('sort_order')->get(),

            // 1. Settings
            'settings' => GeneralSetting::first(),

            // 2. Top Destinations 
            // FIX: Removed ->where('is_active', true) because the column doesn't exist
            'countries' => Country::take(4)->get(),

            // 2a. Affiliates
            'affiliates' => Affiliate::orderBy('sort_order')->get(),

            // 3. Featured Courses
            'featured_courses' => Course::with('university.country')
                ->where('is_featured', true)
                // Removed is_active check to be safe
                ->take(6)
                ->get(),

            // 4. Services
            'services' => Service::take(4)->get(),

            // 5. Testimonials
            'testimonials' => Testimonial::take(5)->get(),

            // 6. Latest Blogs
            // Ensure your Post model has the author relationship defined
            'latest_blogs' => Post::with('author')
                ->latest()
                ->take(4)
                ->get(),
            
            // 7. Video
            'featured_video' => Video::where('is_featured', true)->first(),
        ]);
    }
}