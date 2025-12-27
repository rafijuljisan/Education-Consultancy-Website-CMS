<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index()
    {
        $scholarships = Scholarship::where('is_active', true)
                        ->with('country')
                        ->latest()
                        ->get();
        return view('scholarships.index', compact('scholarships'));
    }

    public function show($slug)
    {
        $scholarship = Scholarship::where('slug', $slug)
                        ->where('is_active', true)
                        ->firstOrFail();
                        
        // Get other scholarships for sidebar
        $others = Scholarship::where('id', '!=', $scholarship->id)
                    ->take(5)
                    ->get();

        return view('scholarships.show', compact('scholarship', 'others'));
    }
}