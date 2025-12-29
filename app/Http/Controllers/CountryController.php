<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CountryController extends Controller
{
    /**
     * Display a listing of all active countries
     * 
     * @return View
     */
    public function index(): View
    {
        // Cache countries list for 1 hour to improve performance
        $countries = Cache::remember('countries.active', 3600, function () {
            return Country::active()
                ->select([
                    'id', 'name', 'slug', 'flag_image', 'cover_image', 
                    'short_description', 'created_at'
                ])
                ->withCount('universities')
                ->orderBy('name')
                ->get();
        });

        // Get settings once (cached in GeneralSetting model if using caching)
        $settings = GeneralSetting::first();

        return view('countries.index', compact('settings', 'countries'));
    }

    /**
     * Display a single country with all details and universities
     * 
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        // Cache individual country pages for 2 hours
        $country = Cache::remember("country.{$slug}", 7200, function () use ($slug) {
            return Country::where('slug', $slug)
                ->where('is_active', true)
                ->with([
                    'universities' => function ($query) {
                        $query->select([
                                'id', 'name', 'slug', 'logo', 'city', 
                                'country_id', 'is_active'
                            ])
                            ->where('is_active', true)
                            ->orderBy('name');
                    }
                ])
                ->firstOrFail();
        });

        $settings = GeneralSetting::first();

        // Set dynamic meta tags for SEO
        $metaTitle = "Study in {$country->name} | " . ($settings->site_name ?? 'Study Abroad');
        $metaDescription = $country->short_description ?? 
            "Discover top universities, costs, visa requirements and scholarships for studying in {$country->name}.";

        return view('countries.show', compact('settings', 'country', 'metaTitle', 'metaDescription'));
    }

    /**
     * Search countries by name
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (empty($query) || strlen($query) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Search query must be at least 2 characters'
            ], 400);
        }

        $countries = Country::active()
            ->select('id', 'name', 'slug', 'flag_image', 'short_description')
            ->where('name', 'LIKE', "%{$query}%")
            ->withCount('universities')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $countries,
            'count' => $countries->count()
        ]);
    }

    /**
     * Compare multiple countries
     * 
     * @param Request $request
     * @return View
     */
    public function compare(Request $request): View
    {
        // Validate slugs
        $slugs = $request->input('countries', []);
        
        if (count($slugs) < 2 || count($slugs) > 4) {
            abort(400, 'Please select 2-4 countries to compare');
        }

        // Get countries data
        $countries = Country::active()
            ->whereIn('slug', $slugs)
            ->with('universities:id,country_id')
            ->get();

        if ($countries->count() < 2) {
            abort(404, 'Not enough valid countries found');
        }

        $settings = GeneralSetting::first();

        return view('countries.compare', compact('settings', 'countries'));
    }

    /**
     * Get popular/featured countries (for homepage)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function featured()
    {
        $countries = Cache::remember('countries.featured', 3600, function () {
            return Country::featured()
                ->select([
                    'id', 'name', 'slug', 'flag_image', 'cover_image',
                    'short_description'
                ])
                ->withCount('universities')
                ->take(6)
                ->get();
        });

        return response()->json([
            'success' => true,
            'data' => $countries
        ]);
    }

    /**
     * Get country statistics (admin/analytics)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function statistics()
    {
        $stats = Cache::remember('countries.statistics', 3600, function () {
            return [
                'total_countries' => Country::count(),
                'active_countries' => Country::active()->count(),
                'countries_with_universities' => Country::has('universities')->count(),
                'total_universities' => \App\Models\University::count(),
                'most_popular' => Country::withCount('universities')
                    ->orderBy('universities_count', 'desc')
                    ->take(5)
                    ->get(['name', 'slug', 'universities_count']),
                'recently_added' => Country::latest()
                    ->take(5)
                    ->get(['name', 'slug', 'created_at']),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Filter countries by criteria
     * 
     * @param Request $request
     * @return View
     */
    public function filter(Request $request): View
    {
        $query = Country::active()->with('universities:id,country_id');

        // Filter by has universities
        if ($request->has('with_universities')) {
            $query->has('universities');
        }

        // Filter by specific criteria in quick_stats
        if ($request->filled('tuition_max')) {
            $query->whereRaw("JSON_EXTRACT(quick_stats, '$[*].value') LIKE ?", ["%{$request->tuition_max}%"]);
        }

        // Sort options
        $sortBy = $request->input('sort', 'name');
        switch ($sortBy) {
            case 'universities':
                $query->withCount('universities')->orderBy('universities_count', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            default:
                $query->orderBy('name');
        }

        $countries = $query->paginate(12);
        $settings = GeneralSetting::first();

        return view('countries.index', compact('settings', 'countries'));
    }

    /**
     * Clear country cache (admin utility)
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCache()
    {
        Cache::forget('countries.active');
        Cache::forget('countries.featured');
        Cache::forget('countries.statistics');

        // Clear individual country caches
        $slugs = Country::pluck('slug');
        foreach ($slugs as $slug) {
            Cache::forget("country.{$slug}");
        }

        return back()->with('success', 'Country cache cleared successfully!');
    }

    /**
     * Get quick stats for a country (AJAX)
     * 
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function quickStats(string $slug)
    {
        $country = Country::where('slug', $slug)
            ->where('is_active', true)
            ->select('id', 'name', 'slug', 'quick_stats')
            ->withCount('universities')
            ->first();

        if (!$country) {
            return response()->json([
                'success' => false,
                'message' => 'Country not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'name' => $country->name,
                'stats' => $country->quick_stats,
                'universities_count' => $country->universities_count
            ]
        ]);
    }

    /**
     * Get living costs for a country (AJAX)
     * 
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function livingCosts(string $slug)
    {
        $country = Country::where('slug', $slug)
            ->where('is_active', true)
            ->select('id', 'name', 'slug', 'living_costs')
            ->first();

        if (!$country) {
            return response()->json([
                'success' => false,
                'message' => 'Country not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'name' => $country->name,
                'costs' => $country->living_costs
            ]
        ]);
    }

    /**
     * Get visa requirements (AJAX)
     * 
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function visaInfo(string $slug)
    {
        $country = Country::where('slug', $slug)
            ->where('is_active', true)
            ->select('id', 'name', 'slug', 'visa_info', 'visa_steps', 'requirements')
            ->first();

        if (!$country) {
            return response()->json([
                'success' => false,
                'message' => 'Country not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'name' => $country->name,
                'visa_info' => $country->visa_info,
                'visa_steps' => $country->visa_steps,
                'requirements' => $country->requirements
            ]
        ]);
    }
}