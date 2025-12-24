<?php

namespace App\Http\Controllers;

use App\Models\LanguageCourse;
use App\Models\GeneralSetting;

class LanguageCourseController extends Controller
{
    public function index()
    {
        return view('languages.index', [
            'settings' => GeneralSetting::first(),
            'courses' => LanguageCourse::where('is_active', true)->get(),
        ]);
    }

    public function show($slug)
    {
        $course = LanguageCourse::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('languages.show', [
            'settings' => GeneralSetting::first(),
            'course' => $course,
        ]);
    }
}