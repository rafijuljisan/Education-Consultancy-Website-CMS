<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\GeneralSetting;

class UniversityController extends Controller
{
    public function show($slug)
    {
        $university = University::where('slug', $slug)
            ->with(['country', 'courses']) // Load Country info and Courses
            ->firstOrFail();

        return view('universities.show', [
            'settings' => GeneralSetting::first(),
            'university' => $university,
        ]);
    }
}