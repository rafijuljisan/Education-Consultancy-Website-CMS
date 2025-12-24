<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Course;
use App\Models\Service;
use App\Models\Post;
use App\Models\Country;
use App\Models\GeneralSetting;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        // If search is empty, redirect home
        if (!$query) {
            return redirect()->route('home');
        }

        return view('search.index', [
            'settings' => GeneralSetting::first(),
            'query' => $query,

            // Search Logic (Simple LIKE queries)
            'countries' => Country::where('name', 'like', "%{$query}%")->get(),

            'universities' => University::where('name', 'like', "%{$query}%")
                                ->orWhere('city', 'like', "%{$query}%")
                                ->get(),

            'courses' => Course::where('title', 'like', "%{$query}%")
                                ->orWhere('level', 'like', "%{$query}%")
                                ->with('university') // Eager load to show University name
                                ->get(),

            'services' => Service::where('title', 'like', "%{$query}%")->get(),

            'posts' => Post::where('title', 'like', "%{$query}%")->get(),
        ]);
    }
}