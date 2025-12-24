<?php

namespace App\Http\Controllers;

use App\Models\Career; // Changed from Job
use App\Models\GeneralSetting;

class CareerController extends Controller
{
    public function index()
    {
        return view('careers.index', [
            'settings' => GeneralSetting::first(),
            'jobs' => Career::where('is_active', true)
                         ->orderBy('is_filled', 'asc') 
                         ->latest()
                         ->get(),
        ]);
    }

    public function show($slug)
    {
        $job = Career::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        return view('careers.show', [
            'settings' => GeneralSetting::first(),
            'job' => $job,
        ]);
    }
}