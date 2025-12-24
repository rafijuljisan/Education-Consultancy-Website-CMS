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

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all data required for the homepage
        return view('home', [
            // 0. Hero Sliders (Active & Sorted) - ADDED
            'sliders' => Slider::active()->get(),

            // 1. Site Settings (Hero Title, Logo, etc.)
            'settings' => GeneralSetting::first(),
            
            // 2. Top Destinations (4 Countries)
            'countries' => Country::take(4)->get(),
            
            // 3. Featured Courses (6 items with University info)
            'featured_courses' => Course::with('university.country')
                                    ->where('is_featured', true)
                                    ->take(6)
                                    ->get(),
                                    
            // 4. Services (Visa, Counseling)
            'services' => Service::where('is_active', true)->take(4)->get(),
            
            // 5. Social Proof
            'testimonials' => Testimonial::where('is_active', true)->take(3)->get(),
            
            // 6. Latest News
            'latest_news' => Post::whereNotNull('published_at')->latest()->take(3)->get(),

            // 7. Featured Video (for the popup/modal section)
            'featured_video' => Video::where('is_featured', true)->first(),
        ]);
    }
}